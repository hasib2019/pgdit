CREATE TABLE tution_fee_collection (
  id int(11) NOT NULL,
  student_id int(11) NOT NULL,
  payment_date date NOT NULL,
  fee_amount decimal(10,0) NOT NULL,
  receipt_number 	varchar(30) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4