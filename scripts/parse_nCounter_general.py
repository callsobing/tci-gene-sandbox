#!/usr/bin/python
import json
import pandas as pd
import matplotlib
matplotlib.use('Agg')
from pylab import *
import numpy as np
from scipy import stats
import os
import sys
import xlwt

plt.rcParams['font.sans-serif'] = ['SimHei']
neg_genes = ["NEG_A", "NEG_B", "NEG_C", "NEG_D", "NEG_E", "NEG_F", "NEG_G", "NEG_H"]
platforms = {
            "抗氧化": {"up": ["SOD1","SOD2","GPX1","CAT"], "down": []},
            "抗老": {"up": ["CCT2","CCT5","CCT6A","CCT7","CCT8","Pink1","Parkin","Atg1","Atg8","SIRT1","FOXO","NADSYN","MRPS5","Ubl-5","SOD3"], "down": ["PARP1","PARP2"]},
            "DNA修復": {"up": ["UNG","OGG1","MPG","APEX1","ERCC1","ERCC6","XPA","XRCC1","XRCC5","MSH2","MLH1","MSH6"], "down": []},
            "免疫": {"up": ["IL-1B","IL-8","IL-6","IL-10","IL-18","TNF-a"], "down": []},
            "護胃": {"up": ["SOD1","SOD2","GPX1"], "down": ["IL-1B","IL-6","IL-8"]},
            "護眼": {"up": [], "down": ["VEGFA","CASP3","CASP8","IL-1B","IL-8","TNF-a"]},
            "抗黑色素生成": {"up": [], "down": ["TYR","TYRP1","MC1R","MITF"]},
            "膠原蛋白合成-組合-降解": {"up": ["COL1A1","COL1A2","COL4A1","COL4A4","COL4A5","TIMP1","ELN","FBN1","LOX","HAS2","HAS3"], "down": ["MMP1","MMP9","MMP2"]},
            "抗發炎": {"up": ["IL-10","TGFB","IL4"], "down": ["IL-1B","IL-8","IL-6","IL-18","TNF-a","IL-16","IL23","IL12A","IFNG","IL3"]},
            "細胞凋亡": {"up": ["BCL-2"], "down": ["BAX","BCLXL","BAD","CASP9","AIFM1","EndoG"]},
            "心血管保健": {"up": ["PTGIS","NOS3","PLAT","PROC"], "down": ["EDN1","VWF","F3","SERPINE1","PDGFC","FGF2","IGF2BP3","IGF1R","IL-8","IL-6","ICAM1","VCAM1","CASP8"]},
            "晝夜節律": {"up": ["SIRT1","CLOCK","BMAL1 (ARNTL)","PER2","CRY","KPNB1"], "down": []},
            "LPS模擬體內發炎": {"up": ["NOS3"], "down": ["ICAM1","VCAM1","IL-8"]},
            "非酒精性肝損傷": {"up": ["UNG","OGG1","MPG","APEX1","ERCC1","ERCC6","XPA","XRCC1","XRCC5","MSH2","MLH1","MSH6","SOD1","SOD2","GPX1","CAT"], "down": []},
            "皮膚角質保濕": {"up": ["Tgm1","Krt1","Keratin 10","Keratin 14","AQP3","FLG-F","SMPD1","GBA","HAS2","HAS3"], "down": []},
            "脂肪肝": {"up": ["PPAR-a"], "down": ["PPAR-g","SREBP-1c (SREBF1)","SCD1 (SCD)","ACC (ACACA)"]},
            "提升HDL": {"up": ["CETP","SCARB1","apoA-I (APA1)","LDLR","ABCA1"], "down": []},
            "健髮平台": {"up": ["KROX20","SCF","VEGFA","IGF1"], "down": ["SRD5A1","SRD5A2","AR","TGFB","BDNF"]},
            "端粒酶活性平台": {"up": ["TERT","TERC","RTEL1"], "down": []},
            "免疫活化與分化": {"up": [], "down": ["CD40","ERBB2","LIF","MALT1","NCK1","PAF1","DYNLL2","GRK5","PSMD4","RDH10","RELB","SCARF1","TNFSF14","ABR","IL13","IL4R","IL5RA","RELA"]}
            }


def significance_score(mean1, mean2):
    try:
        (statistic, pvalue) = stats.ttest_ind(mean1, mean2)
    except:
        pvalue = 1
    if pvalue < 0.001:
        return 3.
    elif pvalue < 0.01:
        return 2.
    elif pvalue < 0.05:
        return 1.
    return 0


def expression_direction_score(direction, expression):
    difference = average(expression) - 1
    check_direction = difference * direction
    multiplier = 1
    if check_direction < 0: # 和預期方向不同就扣分
        multiplier = -1

    if abs(difference) > 0.5:
        return 3. * multiplier
    elif abs(difference) > 0.3:
        return 2. * multiplier
    elif abs(difference) > 0.1:
        return 1. * multiplier
    return 0


def platform_score(gene_details_map):
    output_fh = open("reports/%s/%s/platform_score" % (user_id, report_uuid), "w", encoding="utf-8")
    for platform in platforms:
        score_sum = 0
        gene_count = 0.0
        for gene in platforms[platform]['up']:
            if gene not in gene_details_map:
                continue
            gene_count += 1
            mock_mean = gene_details_map[gene]["mock"]["fold_change"]
            c1t1_mean = gene_details_map[gene]["c1t1"]["fold_change"]
            c1t2_mean = gene_details_map[gene]["c1t2"]["fold_change"]
            c2t1_mean = gene_details_map[gene]["c2t1"]["fold_change"]
            c2t2_mean = gene_details_map[gene]["c2t2"]["fold_change"]
            score_sum += significance_score(mock_mean, c1t1_mean) * expression_direction_score(1, c1t1_mean)
            score_sum += significance_score(mock_mean, c1t2_mean) * expression_direction_score(1, c1t2_mean)
            score_sum += significance_score(mock_mean, c2t1_mean) * expression_direction_score(1, c2t1_mean)
            score_sum += significance_score(mock_mean, c2t2_mean) * expression_direction_score(1, c2t2_mean)
        for gene in platforms[platform]['down']:
            if gene not in gene_details_map:
                continue
            gene_count += 1
            mock_mean = gene_details_map[gene]["mock"]["fold_change"]
            c1t1_mean = gene_details_map[gene]["c1t1"]["fold_change"]
            c1t2_mean = gene_details_map[gene]["c1t2"]["fold_change"]
            c2t1_mean = gene_details_map[gene]["c2t1"]["fold_change"]
            c2t2_mean = gene_details_map[gene]["c2t2"]["fold_change"]
            score_sum += significance_score(mock_mean, c1t1_mean) * expression_direction_score(-1, c1t1_mean)
            score_sum += significance_score(mock_mean, c1t2_mean) * expression_direction_score(-1, c1t2_mean)
            score_sum += significance_score(mock_mean, c2t1_mean) * expression_direction_score(-1, c2t1_mean)
            score_sum += significance_score(mock_mean, c2t2_mean) * expression_direction_score(-1, c2t2_mean)
        if score_sum < 0:
            output_fh.write("%s\t0\n" % platform)
        else:
            output_fh.write("%s\t%.2f\n" % (platform, (score_sum * 100 / (gene_count * 15))))
    output_fh.close()


def platform_xlsx(gene_details_map, sample_identifiers):
    wb = xlwt.Workbook(encoding="utf-8")
    ws = wb.add_sheet('Processed Data')

    row_offset = 0
    for platform in platforms:
        gene_count = 0
        ws.write(row_offset, 1, "AVG")
        ws.write(row_offset, 2, "Mock")
        ws.write(row_offset, 3, sample_identifiers[0])
        ws.write(row_offset, 4, sample_identifiers[1])
        ws.write(row_offset, 5, sample_identifiers[2])
        ws.write(row_offset, 6, sample_identifiers[3])
        ws.write(row_offset, 8, "STD")
        ws.write(row_offset, 9, "Mock")
        ws.write(row_offset, 10, sample_identifiers[0])
        ws.write(row_offset, 11, sample_identifiers[1])
        ws.write(row_offset, 12, sample_identifiers[2])
        ws.write(row_offset, 13, sample_identifiers[3])
        ws.write(row_offset, 15, "TTEST")
        ws.write(row_offset, 16, sample_identifiers[0])
        ws.write(row_offset, 17, sample_identifiers[1])
        ws.write(row_offset, 18, sample_identifiers[2])
        ws.write(row_offset, 19, sample_identifiers[3])
        row_offset += 1
        for gene in platforms[platform]['up']:
            if gene not in gene_details_map:
                continue
            style = xlwt.easyxf('font: colour green, bold True;')
            ws.write(row_offset + gene_count, 1, gene, style)
            mock_mean = gene_details_map[gene]["mock"]["fold_change"]
            c1t1_mean = gene_details_map[gene]["c1t1"]["fold_change"]
            c1t2_mean = gene_details_map[gene]["c1t2"]["fold_change"]
            c2t1_mean = gene_details_map[gene]["c2t1"]["fold_change"]
            c2t2_mean = gene_details_map[gene]["c2t2"]["fold_change"]
            ws.write(row_offset, 2, str(gene_details_map[gene]["mock"]["fold_change"]))
            ws.write(row_offset, 3, str(gene_details_map[gene]["c1t1"]["fold_change"]))
            ws.write(row_offset, 4, str(gene_details_map[gene]["c1t2"]["fold_change"]))
            ws.write(row_offset, 5, str(gene_details_map[gene]["c2t1"]["fold_change"]))
            ws.write(row_offset, 6, str(gene_details_map[gene]["c2t2"]["fold_change"]))
            ws.write(row_offset + gene_count, 8, gene, style)
            ws.write(row_offset, 9,  str(gene_details_map[gene]["mock"]["std"]))
            ws.write(row_offset, 10, str(gene_details_map[gene]["c1t1"]["std"]))
            ws.write(row_offset, 11, str(gene_details_map[gene]["c1t2"]["std"]))
            ws.write(row_offset, 12, str(gene_details_map[gene]["c2t1"]["std"]))
            ws.write(row_offset, 13, str(gene_details_map[gene]["c2t2"]["std"]))
            ws.write(row_offset + gene_count, 15, gene, style)
            ws.write(row_offset, 16, str(stats.ttest_ind(mock_mean, c1t1_mean)[0]))
            ws.write(row_offset, 17, str(stats.ttest_ind(mock_mean, c1t2_mean)[0]))
            ws.write(row_offset, 18, str(stats.ttest_ind(mock_mean, c2t1_mean)[0]))
            ws.write(row_offset, 19, str(stats.ttest_ind(mock_mean, c2t2_mean)[0]))
            gene_count += 1
        for gene in platforms[platform]['down']:
            if gene not in gene_details_map:
                continue
            style = xlwt.easyxf('font: colour red, bold True;')
            ws.write(row_offset + gene_count, 1, gene, style)
            mock_mean = gene_details_map[gene]["mock"]["fold_change"]
            c1t1_mean = gene_details_map[gene]["c1t1"]["fold_change"]
            c1t2_mean = gene_details_map[gene]["c1t2"]["fold_change"]
            c2t1_mean = gene_details_map[gene]["c2t1"]["fold_change"]
            c2t2_mean = gene_details_map[gene]["c2t2"]["fold_change"]
            ws.write(row_offset, 2, str(gene_details_map[gene]["mock"]["fold_change"]))
            ws.write(row_offset, 3, str(gene_details_map[gene]["c1t1"]["fold_change"]))
            ws.write(row_offset, 4, str(gene_details_map[gene]["c1t2"]["fold_change"]))
            ws.write(row_offset, 5, str(gene_details_map[gene]["c2t1"]["fold_change"]))
            ws.write(row_offset, 6, str(gene_details_map[gene]["c2t2"]["fold_change"]))
            ws.write(row_offset + gene_count, 8, gene, style)
            ws.write(row_offset, 9, str(gene_details_map[gene]["mock"]["std"]))
            ws.write(row_offset, 10, str(gene_details_map[gene]["c1t1"]["std"]))
            ws.write(row_offset, 11, str(gene_details_map[gene]["c1t2"]["std"]))
            ws.write(row_offset, 12, str(gene_details_map[gene]["c2t1"]["std"]))
            ws.write(row_offset, 13, str(gene_details_map[gene]["c2t2"]["std"]))
            ws.write(row_offset + gene_count, 15, gene, style)
            ws.write(row_offset, 16, str(stats.ttest_ind(mock_mean, c1t1_mean)[0]))
            ws.write(row_offset, 17, str(stats.ttest_ind(mock_mean, c1t2_mean)[0]))
            ws.write(row_offset, 18, str(stats.ttest_ind(mock_mean, c2t1_mean)[0]))
            ws.write(row_offset, 19, str(stats.ttest_ind(mock_mean, c2t2_mean)[0]))
            gene_count += 1
        ws.write_merge(row_offset, 0, row_offset + gene_count, 0, platform)
        row_offset += gene_count
    wb.save("reports/%s/%s/output.xlsx" % (user_id, report_uuid))


def create_directory(directory_path):
    if not os.path.exists(directory_path):
        os.makedirs(directory_path)
        return True
    else:
        return False


def label_significance(pos_in_fig, mean1, mean2, std, ymax):
    try:
        (statistic, pvalue) = stats.ttest_ind(mean1, mean2)
    except:
        pvalue = 1
    text = ""
    if pvalue < 0.001:
        text = "***"
    elif pvalue < 0.01:
        text = "**"
    elif pvalue < 0.05:
        text = "*"
    if text:
        # Annotate significance level
        plt.annotate(text, xy=(pos_in_fig - 0.05, average(mean2) + std + ymax * 0.005), fontsize="x-large")
        # Annotate Relative Expression ratio
    plt.annotate("{:.2f}".format(average(mean2)), xy=(pos_in_fig - 0.12, average(mean2) - ymax * 0.05), fontsize="x-large")


def plot_gene(gene_details_map, gene, user_id, report_uuid, sample_ids):
    sample_set_list = ["c1t1", "c1t2", "c2t1", "c2t2"]
    sample_color_mapping = {"c1t1": "#705D56", "c1t2": "#B19994", "c2t1": "#D3C0CD", "c2t2": "#E3DFFF"}
    sample_id_mapping = {"c1t1": sample_ids[0], "c1t2": sample_ids[1], "c2t1": sample_ids[2], "c2t2": sample_ids[3]}
    xpos_anchor = 0.5
    x_pos = [0.5]
    colors = ["#3D3A4B"]
    means = [average(gene_details_map[gene]["mock"]["fold_change"])]
    errors = [[0], [gene_details_map[gene]["mock"]["std"]/2]]
    labels = ['控制組']
    for sample_set in sample_set_list:
        if len(gene_details_map[gene][sample_set]["fold_change"]) < 1:
            continue
        means.append(average(gene_details_map[gene][sample_set]["fold_change"]))
        xpos_anchor += 1
        x_pos.append(xpos_anchor)
        errors[0].append(0)
        errors[1].append(gene_details_map[gene][sample_set]["std"]/2)
        labels.append(sample_id_mapping[sample_set])
        colors.append(sample_color_mapping[sample_set])

    fig, ax = plt.subplots()
    # plt.figure(figsize=(6, 7))

    for i in range(len(means)):
        plt.bar(x_pos[i], means[i], 1.0, color=colors[i], align='center', linewidth=0, label=labels[i])
    # plt.bar(x_pos, means, 1.0, color=colors, align='center', linewidth=0, label=labels)
    plotline1, caplines1, barlinecols1 = ax.errorbar(x_pos, means, yerr=errors, lolims=True, ls='None', color='black', barsabove=True)
    lgd = ax.legend(bbox_to_anchor=(1.05, 1), loc='upper left', borderaxespad=0.)

    caplines1[0].set_marker('.')
    caplines1[2].set_marker('_')
    caplines1[0].set_markersize(0)
    caplines1[2].set_markersize(15)

    ymax = max(means) + max(errors[1]) * 2
    plt.ylim(0, ymax)
    plt.xlabel(gene, fontsize="x-large")
    plt.ylabel('Relative Expression Ratio', fontsize="x-large")
    ax.yaxis.set_ticks_position('left')
    ax.xaxis.set_ticks_position('bottom')
    # plt.xticks(x_pos, labels, color='k', fontsize="x-large")
    plt.xticks([])
    plt.yticks(fontsize="x-large")
    plt.gca(). spines['right'].set_visible(False)
    plt.gca().spines['top'].set_visible(False)

    count = 0
    for sample_set in sample_set_list:
        if len(gene_details_map[gene][sample_set]["fold_change"]) < 1:
            continue
        count += 1
        label_significance(x_pos[count], gene_details_map[gene]["mock"]["fold_change"], gene_details_map[gene][sample_set]["fold_change"], errors[1][count], ymax)
    fig.savefig("reports/%s/%s/%s.png" % (user_id, report_uuid, gene), bbox_extra_artists=(lgd,), bbox_inches='tight')
    plt.cla()
    plt.clf()
    plt.close(fig)


file_name = sys.argv[1]
samples_fh = sys.argv[2]
user_id = sys.argv[3]
report_uuid = sys.argv[4]

selected_sample_fh = open(samples_fh, encoding="utf-8")
mock_samples = []
c1t1_samples = []
c1t2_samples = []
c2t1_samples = []
c2t2_samples = []
sample_identifiers = []
count = 0
for line in selected_sample_fh:
    line = line.rstrip()
    splitted = line.split("\t")
    if count == 0:
        sample_identifiers = splitted
        count += 1
        continue
    if count == 1:
        mock_samples = splitted
        count += 1
        continue
    if count == 2:
        c1t1_samples = splitted
        count += 1
        continue
    if count == 3:
        c1t2_samples = splitted
        count += 1
        continue
    if count == 4:
        c2t1_samples = splitted
        count += 1
        continue
    if count == 5:
        c2t2_samples = splitted
        continue
selected_sample_fh.close()

with open(file_name, 'r', errors="ignore", encoding="utf-8") as f:
    nCounter_fh = f.readlines()

samples_idx = {}
gene_names = []
expression_map = {}
count = 0
for line in nCounter_fh:
    line = line.rstrip()
    splitted = line.split("\t")
    if count == 1:
        for idx in range(8, len(splitted)):
            samples_idx["{:02d}".format(idx) + ":" + splitted[idx]] = idx
            expression_map["{:02d}".format(idx)  + ":" + splitted[idx]] = []
        count += 1
        continue
    if count < 3:
        count += 1
        continue
    gene_names.append(splitted[0])
    for sample in samples_idx:
        expression_map[sample].append(splitted[samples_idx[sample]])  # 最後輸出格式: expression_map: 以sample名字為key，按照次序記錄各基因表現量

gene_details_map = {}
# 初始化gene maps
for gene_idx in range(len(gene_names)):
    gene_details_map[gene_names[gene_idx]] = \
        {
        "mock": {"fold_change": [1, 1, 1], "std": 0},
        "c1t1": {"fold_change": [], "std": 0.0},
        "c1t2": {"fold_change": [], "std": 0.0},
        "c2t1": {"fold_change": [], "std": 0.0},
        "c2t2": {"fold_change": [], "std": 0.0}
        }

threshold = 20.0001

for gene_idx in range(len(gene_names)):
    mock_sum = 0
    count = 0
    for mock_id in mock_samples:
        mock_idx = samples_idx[mock_id]
        if float(expression_map[mock_id][gene_idx]) < threshold:
            count += 1
            continue
        mock_sum += float(expression_map[mock_id][gene_idx])
    if count == 2 or mock_sum == 0:  # 如果剛好兩個mock沒有超過threshold就丟棄這個gene
        gene_details_map.pop(gene_names[gene_idx])
        continue
    count = 0
    mock_avg = mock_sum / float(len(mock_samples))

    for cond1_sample in c1t1_samples:
        sample_idx = samples_idx[cond1_sample]
        if float(expression_map[cond1_sample][gene_idx]) < threshold:
            count += 1
            continue
        gene_details_map[gene_names[gene_idx]]["c1t1"]["fold_change"].append(float(expression_map[cond1_sample][gene_idx]) / mock_avg)
    gene_details_map[gene_names[gene_idx]]["c1t1"]["std"] = np.std(gene_details_map[gene_names[gene_idx]]["c1t1"]["fold_change"])
    if count > 1: # 如果超過兩個mock沒有超過threshold就丟棄這個gene
        gene_details_map[gene_names[gene_idx]]["c1t1"]["fold_change"] = []
        gene_details_map[gene_names[gene_idx]]["c1t1"]["std"] = 0.0
    count = 0

    for cond2_sample in c1t2_samples:
        sample_idx = samples_idx[cond2_sample]
        if float(expression_map[cond2_sample][gene_idx]) < threshold:
            count += 1
            continue
        gene_details_map[gene_names[gene_idx]]["c1t2"]["fold_change"].append(float(expression_map[cond2_sample][gene_idx]) / mock_avg)
    gene_details_map[gene_names[gene_idx]]["c1t2"]["std"] = np.std(gene_details_map[gene_names[gene_idx]]["c1t2"]["fold_change"])
    if count > 1:  # 如果超過兩個mock沒有超過threshold就丟棄這個gene
        gene_details_map[gene_names[gene_idx]]["c1t2"]["fold_change"] = []
        gene_details_map[gene_names[gene_idx]]["c1t2"]["std"] = 0.0
    count = 0

    for cond1_sample in c2t1_samples:
        sample_idx = samples_idx[cond1_sample]
        if float(expression_map[cond1_sample][gene_idx]) < threshold:
            count += 1
            continue
        gene_details_map[gene_names[gene_idx]]["c2t1"]["fold_change"].append(float(expression_map[cond1_sample][gene_idx]) / mock_avg)
    gene_details_map[gene_names[gene_idx]]["c2t1"]["std"] = np.std(gene_details_map[gene_names[gene_idx]]["c2t1"]["fold_change"])
    if count > 1:  # 如果超過兩個mock沒有超過threshold就丟棄這個gene
        gene_details_map[gene_names[gene_idx]]["c2t1"]["fold_change"] = []
        gene_details_map[gene_names[gene_idx]]["c2t1"]["std"] = 0.0
    count = 0

    for cond2_sample in c2t2_samples:
        sample_idx = samples_idx[cond2_sample]
        if float(expression_map[cond2_sample][gene_idx]) < threshold:
            count += 1
            continue
        gene_details_map[gene_names[gene_idx]]["c2t2"]["fold_change"].append(float(expression_map[cond2_sample][gene_idx]) / mock_avg)
    gene_details_map[gene_names[gene_idx]]["c2t2"]["std"] = np.std(gene_details_map[gene_names[gene_idx]]["c2t2"]["fold_change"])
    if count > 1:  # 如果超過兩個mock沒有超過threshold就丟棄這個gene
        gene_details_map[gene_names[gene_idx]]["c2t2"]["fold_change"] = []
        gene_details_map[gene_names[gene_idx]]["c2t2"]["std"] = 0.0
    count = 0

# 這邊應該要新增一個資料夾叫做report專門存相關資料
# report下面新開uuid的資料夾 - "/使用者名稱/uuid/"
if create_directory("reports/%s/%s/" % (user_id, report_uuid)):
    for gene_idx in range(len(gene_names)):
        if gene_names[gene_idx] in gene_details_map:
            plot_gene(gene_details_map, gene_names[gene_idx], user_id, report_uuid, sample_identifiers)
    platform_score(gene_details_map)
    platform_xlsx(gene_details_map, sample_identifiers)
else:
    print("Cannot create directory!!")