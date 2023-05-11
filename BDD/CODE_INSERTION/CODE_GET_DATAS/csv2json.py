import pandas as pd
import json


#Function in order to transform the csv file we download into a json one
df = pd.read_csv('books.csv')

data = df.to_dict(orient='records')

with open('books.json', 'w') as f:
    json.dump(data, f,indent=3)