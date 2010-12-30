-- query ini khusus utk KI, lakukan setelah import tb customer_temp

update customer c, member m
set c.cust_member = m.member_id
where m.member_cust = c.cust_id;

update member m
set m.member_valid = date_add(date_format(m.member_register, '%Y-%m-%d'), INTERVAL 1 year);