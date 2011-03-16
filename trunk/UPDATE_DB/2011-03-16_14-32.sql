/*set fretfulness 'Medium'*/
update customer set cust_fretfulness = 'Medium' where cust_fretfulness = '' or cust_fretfulness='Undefined';