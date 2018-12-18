import sys
import numpy as np

uuid = sys.argv[2]
# nCounter_fh = open("../uploaded_files/20181115_FTB 2-7-4-2 & FTB 2-5-6-2.txt")

first = True
line_idx = 0
sample_data = {}
sample_ids = []

with open(sys.argv[1], 'r', errors="ignore", encoding="utf-8") as f:
    nCounter_fh = f.readlines()


for line in nCounter_fh:
    print(line)
    line = line.rstrip()
    if first:
        first = False
        line_idx += 1
        continue
    splitted = line.split("\t")
    for i in range(8, len(splitted)):
        if line_idx == 1:
            sample_id = "{:02d}".format(i) + ":" + splitted[i]
            sample_data[sample_id] = []
            sample_ids.append(sample_id)
            continue
        if line_idx == 2:
            continue
        sample_data[sample_ids[i-8]].append(float(splitted[i]))
    line_idx += 1

output_fh = open("data/nCounter_%s.txt" % uuid, "w")

# 輸出格式: print("Sample_id\tExpr avg\tExpr std")
first = True
for key in sorted(sample_data):
    if first:
        output_fh.write("%s\t%.2f\t%.2f" % (key, np.average(sample_data[key]), np.std(sample_data[key])))
        first = False
        continue
    output_fh.write("\n%s\t%.2f\t%.2f" % (key, np.average(sample_data[key]), np.std(sample_data[key])))
output_fh.close()