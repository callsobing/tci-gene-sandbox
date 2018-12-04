#!/usr/bin/python
import json
import pandas as pd
import matplotlib
matplotlib.use('Agg')
import matplotlib.pyplot as plt
from pylab import *
import numpy as np
import scipy
import os
import sys


# file_name = sys.argv[1]
file_name = "test.xlsx"

def create_directory(directory_path):
    if not os.path.exists(directory_path):
        os.makedirs(directory_path)
        return True
    else:
        return False


def label_significance(pos_in_fig, mean, std, ymax):
    (statistic, pvalue) = scipy.stats.ttest_ind_from_stats(mean1=mean, std1=std, nobs1=3, mean2=1, std2=0, nobs2=3)
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
        plt.annotate(text, xy=(pos_in_fig - 0.05, mean + std + ymax * 0.005), fontsize="xx-large")
        # Annotate Relative Expression ratio
        plt.annotate("{:.2f}".format(mean), xy=(pos_in_fig - 0.12, mean - ymax * 0.05), fontsize="x-large")


def plot_gene(gene_details_map, gene, file_name):
    fig, ax = plt.subplots()
    plt.figure(figsize=(5.5, 7))
    mock_mean = average(gene_details_map[gene]["mock"]["fold_change"])
    mean_6h1 = average(gene_details_map[gene]["6h_1"]["fold_change"])
    mean_6h2 = average(gene_details_map[gene]["6h_2"]["fold_change"])
    x_pos = [0, 1, 2]
    means = [mock_mean, mean_6h1, mean_6h2]
    errors = [gene_details_map[gene]["mock"]["std"], gene_details_map[gene]["6h_1"]["std"],
              gene_details_map[gene]["6h_2"]["std"]]

    labels = ('mock', '6h_1', '6h_2')
    error_kw = {"barsabove": True}
    ax.p1 = plt.bar(x_pos, means, yerr=errors, align='center', alpha=0.5, ecolor='black', capsize=8, width=0.8, error_kw=error_kw)

    ymax = max(means) + max(errors) * 1.5
    plt.ylim(ymax=ymax)
    plt.xlabel(gene, fontsize="x-large")
    plt.ylabel('Relative Expression Ratio', fontsize="x-large")
    plt.xticks(x_pos, labels, color='k', fontsize="x-large")
    plt.yticks(fontsize="x-large")
    plt.gca().spines['right'].set_color('none')
    plt.gca().spines['top'].set_color('none')

    label_significance(1, means[1], errors[1], ymax)
    label_significance(2, means[2], errors[2], ymax)
    plt.savefig("figures/%s/%s.png" % (file_name, gene))
    plt.cla()
    plt.close(fig)


plt.rcParams['font.sans-serif'] = ['SimHei']
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

df_uht = pd.read_excel(io="uploaded_files/%s" % file_name, sheetname="Sheet1")
uht_list = df_uht.values.tolist()[1:]
exp_identifiers = list(df_uht)
gene_names = df_uht.index.values[1:]

experiments_expr_map = {}
for exp_idx in range(len(exp_identifiers)):
    if exp_identifiers[exp_idx] not in experiments_expr_map:
        experiments_expr_map[exp_identifiers[exp_idx]] = {}
    for gene_idx in range(len(gene_names)):
        experiments_expr_map[exp_identifiers[exp_idx]][gene_names[gene_idx]] = uht_list[gene_idx][exp_idx]

gene_details_map = {}
for gene_idx in range(len(gene_names)):
    mock_avg = average([uht_list[gene_idx][0], uht_list[gene_idx][1], uht_list[gene_idx][2]])
    gene_details_map[gene_names[gene_idx]] = \
        {
        "mock": {"fold_change": [1, 1, 1], "std": 0},
        "6h_1": {"fold_change": [uht_list[gene_idx][3]/mock_avg, uht_list[gene_idx][4]/mock_avg, uht_list[gene_idx][5]/mock_avg],
                 "std": np.std([uht_list[gene_idx][3]/mock_avg, uht_list[gene_idx][4]/mock_avg, uht_list[gene_idx][5]/mock_avg])},
        "6h_2": {"fold_change": [uht_list[gene_idx][6]/mock_avg, uht_list[gene_idx][7]/mock_avg, uht_list[gene_idx][8]/mock_avg],
                 "std": np.std([uht_list[gene_idx][6]/mock_avg, uht_list[gene_idx][7]/mock_avg, uht_list[gene_idx][8]/mock_avg])},
        "24h_1": {"fold_change": [uht_list[gene_idx][9]/mock_avg, uht_list[gene_idx][10]/mock_avg, uht_list[gene_idx][11]/mock_avg],
                 "std": np.std([uht_list[gene_idx][9]/mock_avg, uht_list[gene_idx][10]/mock_avg, uht_list[gene_idx][11]/mock_avg])},
        "24h_2": {"fold_change": [uht_list[gene_idx][12]/mock_avg, uht_list[gene_idx][13]/mock_avg, uht_list[gene_idx][14]/mock_avg],
                 "std": np.std([uht_list[gene_idx][12]/mock_avg, uht_list[gene_idx][13]/mock_avg, uht_list[gene_idx][14]/mock_avg])}
        }

if create_directory("figures/%s" % file_name):
    for gene_idx in range(len(gene_names)):
        plot_gene(gene_details_map, gene_names[gene_idx], file_name)
else:
    print("Cannot create directory!!")