import sys
import numpy as np

nCounter_fh = open(sys.argv[1])
uuid = sys.argv[2]
# nCounter_fh = open("../uploaded_files/20181115_FTB 2-7-4-2 & FTB 2-5-6-2.txt")

first = True
line_idx = 0
sample_data = {}
sample_ids = []
for line in nCounter_fh:
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
for key in sorted(sample_data, ):
    output_fh.write("%s\t%.2f\t%.2f\n" % (key, np.average(sample_data[key]), np.std(sample_data[key])))
output_fh.close()