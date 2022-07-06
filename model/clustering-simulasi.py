import random
import pandas as pd

# Input Location & Day

locations = [[1.2, 4.2],
             [3.2, 5.1],
             [2.2, 6.2]] 
day = 3

# ATAU
# locations = pd.read_json(directory).tolist()
# locations = pd.read_csv(directory).tolist()

# Fungsi yang ngebuat cluster secara random (tanpa machine learning) 
def cluster(locations, day):
    if len(locations) < day:
        return "Jumlah lokasi harus lebih banyak dari jumlah hari"
    else:
        for location in locations:
            location.append(random.randint(1,day))

# Contoh output
# locations =  [[1.2,4.2, 2],
#               [3.2,5.1, 3],
#               [2.2,6.2, 1]] 

