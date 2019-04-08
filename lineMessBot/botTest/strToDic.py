import ast
string = "{'c_user': '100035463039821', 'datr': 'vampXKKHKkOepCd-YZ4648jH', 'fr': '1YQGt49zJ2vuuAS9n.AWVYDUUHvjYJmqgbRz4JdvMdJMQ.Bcqam9.EG.AAA.0.0.Bcqam-.AWWF5OIi', 'noscript': '1', 'sb': 'vampXOtqf6d7Fy8Rds5scfNJ', 'spin': 'r.1000576829_b.trunk_t.1554622912_s.1_v.2_', 'xs': '30%3AvIYSoS6ACanKaA%3A2%3A1554622910%3A-1%3A-1'}"
print(ast.literal_eval(string))