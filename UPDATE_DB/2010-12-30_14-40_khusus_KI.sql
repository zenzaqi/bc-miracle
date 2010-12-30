-- query ini khusus utk KI, lakukan setelah import tb customer_temp

TRUNCATE `member`;

update customer c, member m
set c.cust_member = m.member_id
where m.member_cust = c.cust_id;