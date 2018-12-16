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
plt.rcParams['font.sans-serif'] = ['SimHei']

file_name = sys.argv[1]
samples_fh = sys.argv[2]
user_id = sys.argv[3]
report_uuid = sys.argv[4]


def create_directory(directory_path):
    if not os.path.exists(directory_path):
        os.makedirs(directory_path)
        return True
    else:
        return False


def label_significance(pos_in_fig, mean1, mean2, std, ymax):
    (statistic, pvalue) = stats.ttest_ind(mean1, mean2)
    text = ""
    if pvalue < 0.001:
        # text = "p-value: %s\n***" % "{:.4f}".format(pvalue)
        text = "***"
    elif pvalue < 0.01:
        # text = "p-value: %s\n**" % "{:.4f}".format(pvalue)
        text = "**"
    elif pvalue < 0.05:
        # text = "p-value: %s\n*" % "{:.4f}".format(pvalue)
        text = "*"
    if text:
        # Annotate significance level
        plt.annotate(text, xy=(pos_in_fig - 0.05, average(mean2) + std + ymax * 0.005), fontsize="x-large")
        # Annotate Relative Expression ratio
    plt.annotate("{:.2f}".format(average(mean2)), xy=(pos_in_fig - 0.12, average(mean2) - ymax * 0.05), fontsize="x-large")


def plot_gene(gene_details_map, gene, user_id, report_uuid):
    mock_mean = average(gene_details_map[gene]["mock"]["fold_change"])
    mean_6h1 = average(gene_details_map[gene]["cond1"]["fold_change"])
    mean_6h2 = average(gene_details_map[gene]["cond2"]["fold_change"])
    x_pos = (0.5, 1.5, 2.5)
    means = (mock_mean, mean_6h1, mean_6h2)
    errors = [[0, 0, 0], [gene_details_map[gene]["mock"]["std"]/2,
              gene_details_map[gene]["cond1"]["std"]/2,
              gene_details_map[gene]["cond2"]["std"]/2]]

    labels = ('mock', 'cond1', 'cond2')
    fig, ax = plt.subplots()
    # plt.figure(figsize=(6, 7))

    plt.bar(x_pos, means, 0.7, color='lightskyblue', align='center', linewidth=0)
    plotline1, caplines1, barlinecols1 = ax.errorbar(x_pos, means, yerr=errors, lolims=True, ls='None', color='black', barsabove=True)

    caplines1[0].set_marker('.')
    caplines1[2].set_marker('_')
    caplines1[0].set_markersize(0)
    caplines1[2].set_markersize(10)

    ymax = max(means) + max(errors[1]) * 2
    plt.ylim(ymax=ymax)
    plt.xlabel(gene, fontsize="x-large")
    plt.ylabel('Relative Expression Ratio', fontsize="x-large")
    plt.xticks(x_pos, labels, color='k', fontsize="x-large")
    plt.yticks(fontsize="x-large")
    plt.gca().spines['right'].set_color('none')
    plt.gca().spines['top'].set_color('none')

    label_significance(x_pos[1], gene_details_map[gene]["mock"]["fold_change"], gene_details_map[gene]["cond1"]["fold_change"], errors[1][1], ymax)
    label_significance(x_pos[2], gene_details_map[gene]["mock"]["fold_change"], gene_details_map[gene]["cond2"]["fold_change"], errors[1][2], ymax)
    plt.savefig("reports/%s/%s/%s.png" % (user_id, report_uuid, gene))
    plt.cla()
    plt.close(fig)


platforms = {"抗氧化": {"up": ["SOD1","SOD2","GPX1","CAT"], "down": []},
            "抗老": {"up": ["CCT2","CCT5","CCT6A","CCT7","CCT8","Pink1","Parkin","Atg1","Atg8","SIRT1","FOXO","NADSYN","MRPS5","Ubl-5","SOD3"], "down": ["PARP1","PARP2"]},
            "DNA修復": {"up": ["UNG","OGG1","MPG","APEX1","ERCC1","ERCC6","XPA","XRCC1","XRCC5","MSH2","MLH1","MSH6"], "down": []},
            "免疫": {"up": ["IL-1B","IL-8","IL-6","IL-10","IL-18","TNF-a"], "down": []},
            "護胃": {"up": ["SOD1","SOD2","GPX1"], "down": ["IL-1B","IL-6","IL-8"]},
            "護眼": {"up": [], "down": ["VEGFA","CASP3","CASP8","IL-1B","IL-8","TNF-a"]},
            "美白-抗黑色素生成": {"up": [], "down": ["TYR","TYRP1","MC1R","MITF"]},
            "膠原蛋白合成、組合、與降解": {"up": ["COL1A1","COL1A2","COL4A1","COL4A4","COL4A5","TIMP1","ELN","FBN1","LOX","HAS2","HAS3"], "down": ["MMP1","MMP9","MMP2"]},
            "抗發炎": {"up": ["IL-10","TGFB","IL4"], "down": ["IL-1B","IL-8","IL-6","IL-18","TNF-a","IL-16","IL23","IL12A","IFNG","IL3"]},
            "細胞凋亡": {"up": [], "down": ["BCL-2","BAX","BCLXL","BAD","CASP9","AIFM1","EndoG"]},
            "心血管保健": {"up": ["PTGIS","NOS3","PLAT","PROC"], "down": ["EDN1","VWF","F3","SERPINE1","PDGFC","FGF2","IGF2BP3","IGF1R","IL-8","IL-6","ICAM1","VCAM1","CASP8"]},
            "晝夜節律": {"up": ["SIRT1","CLOCK","BMAL1 (ARNTL)","PER2","CRY","KPNB1"], "down": []},
            "以LPS模擬體內受到發炎反應": {"up": ["NOS3"], "down": ["ICAM1","VCAM1","IL-8"]},
            "非酒精性肝損傷": {"up": ["UNG","OGG1","MPG","APEX1","ERCC1","ERCC6","XPA","XRCC1","XRCC5","MSH2","MLH1","MSH6","SOD1","SOD2","GPX1","CAT"], "down": []},
            "皮膚角質保濕": {"up": ["Tgm1","Krt1","Keratin 10","Keratin 14","AQP3","FLG-F","SMPD1","GBA","HAS2","HAS3"], "down": []},
            "脂肪肝": {"up": ["PPAR-g","PPAR-a"], "down": ["SREBP-1c (SREBF1)","SCD1 (SCD)","ACC (ACACA)"]},
            "提升HDL": {"up": ["CETP","SCARB1","apoA-I (APA1)","LDLR","ABCA1"], "down": []},
            "健髮平台": {"up": ["KROX20","SCF","VEGFA","IGF1"], "down": ["SRD5A1","SRD5A2","AR","TGFB","BDNF"]},
            "端粒酶活性平台": {"up": ["TERT","TERC","RTEL1"], "down": []},
            "促進免疫活化與分化": {"up": [], "down": ["CD40","ERBB2","LIF","MALT1","NCK1","PAF1","DYNLL2","GRK5","PSMD4","RDH10","RELB","SCARF1","TNFSF14","ABR","IL13","IL4R","IL5RA","RELA"]}
            }

selected_sample_fh = open(samples_fh)
mock_samples = []
cond1_samples = []
cond2_samples = []
count = 0
for line in selected_sample_fh:
    line = line.rstrip()
    splitted = line.split("\t")
    if count == 0:
        mock_samples = splitted
        count += 1
        continue
    if count == 1:
        cond1_samples = splitted
        count += 1
        continue
    if count == 2:
        cond2_samples = splitted
        continue
selected_sample_fh.close()


nCounter_fh = open(file_name)
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
        "cond1": {"fold_change": [], "std": 0.0},
        "cond2": {"fold_change": [], "std": 0.0},
        }
    gene_details_map[gene_names[gene_idx]] = \
        {
            "mock": {"fold_change": [1, 1, 1], "std": 0},
            "cond1": {"fold_change": [], "std": 0.0},
            "cond2": {"fold_change": [], "std": 0.0}
        }

for gene_idx in range(len(gene_names)):
    mock_sum = 0
    for mock_id in mock_samples:
        mock_idx = samples_idx[mock_id]
        mock_sum += float(expression_map[mock_id][gene_idx])
    mock_avg = mock_sum / float(len(mock_samples))
    for cond1_sample in cond1_samples:
        sample_idx = samples_idx[cond1_sample]
        gene_details_map[gene_names[gene_idx]]["cond1"]["fold_change"].append(float(expression_map[cond1_sample][gene_idx]) / mock_avg)
    gene_details_map[gene_names[gene_idx]]["cond1"]["std"] = np.std(gene_details_map[gene_names[gene_idx]]["cond1"]["fold_change"])

    for cond2_sample in cond2_samples:
        sample_idx = samples_idx[cond2_sample]
        gene_details_map[gene_names[gene_idx]]["cond2"]["fold_change"].append(float(expression_map[cond2_sample][gene_idx]) / mock_avg)
    gene_details_map[gene_names[gene_idx]]["cond2"]["std"] = np.std(gene_details_map[gene_names[gene_idx]]["cond2"]["fold_change"])

# 這邊應該要新增一個資料夾叫做report專門存相關資料
# report下面新開uuid的資料夾 - "/使用者名稱/uuid/"
if create_directory("reports/%s/%s/" % (user_id, report_uuid)):
    for gene_idx in range(len(gene_names)):
        plot_gene(gene_details_map, gene_names[gene_idx], user_id, report_uuid)
else:
    print("Cannot create directory!!")