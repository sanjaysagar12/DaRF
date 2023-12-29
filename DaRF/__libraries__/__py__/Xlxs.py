

import gspread as gs
import pandas as pd
import argparse
import json

"""
Xlxs.py -f "*" -> Returns All Data
Xlxs.py -f "brand" -> Return All Brand With Distinct
Xlxs.py -f "*" -b 'bmw' -> Return every data of bmw
Xlxs.py -f "*" -b 'bmw' -d model -> return Distinct Model of Brand Bmw
"""

def Argument():
    parser = argparse.ArgumentParser()
    parser.add_argument('--field', '-f',help='Specify Field')
    parser.add_argument('--brand', '-b',help='Specify Brand')
    parser.add_argument('--model', '-m',help='Specify Model')
    parser.add_argument('--year', '-y',help='SpecifyYear')
    parser.add_argument('--price', '-p',help='Specify Price')
    parser.add_argument('--distinct', '-d',help='get distinct value of Specific Field it should be used with -f or --field')
    args = vars(parser.parse_args())
    return args['field'],args['brand'],args['model'],args['year'],args['price'],args['distinct']

#This function take dictionay and fild ,it return unique value in dataframe

def GetDistinctField(data,field):
    #to get unique value and sort the 
    field = sorted(list(set(data[field].values())))
    
    dataframe = pd.DataFrame(field).T
    return dataframe


#it Finter Data With respect to Given Field and Data
def FilterData(dataframe,field,data):
    return dataframe[dataframe[field]==data]

#it Converts DataFrame To Json
def getJson(dataframe):
    return dataframe.to_json()


args = Argument()
gc = gs.service_account(filename='/var/www/cardata-409603-1d6cbceeac46.json')
sheet = gc.open_by_url('https://docs.google.com/spreadsheets/d/14LJWfSGS9rRST5pvAf5Lpz3w6qoGLcYK5tgPftdcC80/edit?pli=1#gid=1363470746')

ws = sheet.worksheet('Sheet1')
dataframe = pd.DataFrame(ws.get_all_records())

dataframe.head()

#dataframe = pd.read_excel('/var/www/CarData.xlsx')

#to Fetch all Data From Xl
""""
{
    0 => field,
    1 => brand,
    2 => model,
    3 => year,
    4 => price,
    5 =>distinct

}

"""
if(args[0] != None):
    Display = False

    if(args[1]!=None and args[1]!='None'):
        dataframe = FilterData(dataframe,"brand",args[1])
        Display = True
        
    if(args[2]!=None and args[2]!='None'):
        dataframe = FilterData(dataframe,"model",args[2])
        Display = True
    
    if(args[3]!=None and args[3]!='None'):
        dataframe = FilterData(dataframe,"year",int(args[3]))
        Display = True
        
    if(args[4]!=None and args[4]!='None'):
        dataframe = dataframe[dataframe.price <= int(args[4])]
        Display = True

    if(args[5]!=None and args[5]!='None'):
        if(args[5]=='brand'):
            dataframe = dataframe.brand
        elif(args[5]=='model'):
            dataframe = dataframe.model
        elif(args[5]=='year'):
            dataframe = dataframe.year
        List = list(set(dataframe.values.tolist()))
        
        dataframe = pd.DataFrame(List,columns=[args[5]])
        print(getJson(dataframe))
        exit()

    if(Display):
        print(getJson(dataframe))
        exit()

    elif(args[0]!="*"):
        dict = dataframe.to_dict()
        dataframe = GetDistinctField(dict,args[0])
        print(getJson(dataframe))
        exit()

if(args[0]=="*"):
    print(getJson(dataframe))
    exit()

if(args[1]!=None and args[1]!='None'):
    dataframe = FilterData(dataframe,"brand",args[1])

if(args[2]!=None and args[2]!='None'):
    dataframe = FilterData(dataframe,"model",args[2])

if(args[3]!=None and args[3]!='None'):
    dataframe = FilterData(dataframe,"year",int(args[3]))

print(getJson(dataframe))
exit()