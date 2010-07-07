DELETE master_jual_paket,detail_jual_paket,jual_card FROM master_jual_paket,detail_jual_paket,jual_card
WHERE jpaket_id=dpaket_master AND jcard_ref=jpaket_nobukti AND jpaket_cust=58

DELETE master_jual_paket,jual_card FROM master_jual_paket,jual_card
WHERE jcard_ref=jpaket_nobukti AND jpaket_cust=58
