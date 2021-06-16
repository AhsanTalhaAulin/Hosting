mysql -u magento -pmagento<<EOF
    drop database hosting;
    create database hosting;
    use hosting;
    source hosting.sql


    exit;


EOF