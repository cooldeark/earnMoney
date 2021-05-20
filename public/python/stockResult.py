import os
import sys
import json
# import twstock

searchStock=sys.argv[1]
# print(json.dumps({'timestamp': 1620973800.0, 'info': {'code': '2330', 'channel': '2330.tw', 'name': '台積電', 'fullname': '台灣積體電路製造股份有限公司', 'time': '2021-05-14 06:30:00'}, 'realtime': {'latest_trade_price': '557.0000', 'trade_volume': '2953', 'accumulate_trade_volume': '37287', 'best_bid_price': ['567.0000', '555.0000', '554.0000', '553.0000', '552.0000'], 'best_bid_volume': ['151', '100', '178', '231', '473'], 'best_ask_price': ['557.0000', '558.0000', '559.0000', '560.0000', '561.0000'], 'best_ask_volume': ['494', '789', '494', '1049', '343'], 'open': '556.0000', 'high': '562.0000', 'low': '552.0000'}, 'success': True}))
myResult=twstock.realtime.get(searchStock)
print(json.dumps(myResult))