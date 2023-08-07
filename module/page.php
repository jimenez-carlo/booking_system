<?php
require('../database/connection.php');
require_once('../class/main.php');
require_once('../class/shop.php');
require_once('common.php');
require_once('../class/base.php');
require_once('../class/customer.php');

if (!$_GET || !isset($_GET['page'])) {
  echo get_contents('../layout/user-page/content/not_found.php');
  die;
}

$page = $_GET['page'];
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$access = (isset($_SESSION['user']) && !empty($_SESSION['user'])) ? $_SESSION['user']->access_id : null;
$customer_id = (isset($_SESSION['user']) && !empty($_SESSION['user'])) ? $_SESSION['user']->id : null;
$pages = get_access($access);

if (in_array($page, $pages)) {
  $data = array();
  $request = new Base($conn);
  $shop = new Shop($conn);
  $customer = new Customer($conn);
  switch ($page) {
      // Admin
    case 'admin_customer_list':
      $data['customers'] = $request->get_list("select g.gender,UPPER(cc.name) as 'company',UPPER(a.name) as 'access',ui.*,u.*,p.name as province,c.name as city,b.name as barangay from tbl_customers u inner join tbl_customers_info ui on ui.id = u.id inner join tbl_access a on a.id = u.access_id inner join tbl_gender g on g.id = ui.gender_id and u.is_deleted = 0 left join tbl_province p on p.id = ui.province left join tbl_city c on c.id = ui.city left join tbl_barangay b on b.id = ui.barangay inner join tbl_company cc on cc.id = u.company_id ");
      break;
    case 'admin_customer_list2':
      $data['customers'] = $request->get_list("select g.gender,UPPER(cc.name) as 'company',UPPER(a.name) as 'access',ui.*,u.*,p.name as province,c.name as city,b.name as barangay from tbl_customers u inner join tbl_customers_info ui on ui.id = u.id inner join tbl_access a on a.id = u.access_id inner join tbl_gender g on g.id = ui.gender_id and u.is_deleted = 0 left join tbl_province p on p.id = ui.province left join tbl_city c on c.id = ui.city left join tbl_barangay b on b.id = ui.barangay inner join tbl_company cc on cc.id = u.company_id ");
      break;
    case 'admin_customer_create':
      $data['gender'] = $request->get_gender();
      $data['province'] = $request->get_province();
      $data['city'] = $request->get_city();
      $data['barangay'] = $request->get_barangay();
      $data['company'] = $request->get_company();
      break;
    case 'admin_customer_edit':
      $tmp = $request->get_one("select ui.*,u.* from tbl_customers u inner join tbl_customers_info ui on ui.id = u.id where u.id = $id ");
      $data['gender'] = $request->get_gender();
      $data['province'] = $request->get_province();
      $data['city'] = $request->get_city($tmp->province);
      $data['barangay'] = $request->get_barangay($tmp->city);
      $data['info'] = $tmp;
      $data['company'] = $request->get_company();

      $data['payment_history'] = $request->get_list("select p.*,c.name as company from tbl_invoice_payment p left join tbl_company c on c.id = p.company_id where p.customer_id = $id and p.is_deleted = 0");
      $data['disbursement_history'] = $request->get_list("select t.*,c.name as company from tbl_invoice_transaction t left join tbl_company c on c.id = t.company_id where t.customer_id = $id and t.is_deleted = 0 and t.reference_type = 'disbursement'");
      $data['invoice_history'] = $request->get_list("SELECT  t.due_date,sum(if(ti.reference_type ='profit', IFNULL(ti.amount,0), 0)) - (sum(if(ti.reference_type ='expense', IFNULL(ti.amount,0), 0)) + sum(IFNULL(tx.amount,0)))   as invoice_total,  sum(IFNULL(p.amount,0)) as payment_total,ti.*,c.name as company,t.id FROM tbl_invoice t left join tbl_invoice_transaction ti on ti.invoice = t.invoice left join tbl_company c on c.id = ti.company_id left join tbl_invoice_payment p on p.invoice = t.invoice left join tbl_invoice_tax tx on tx.invoice = t.invoice where ti.reference_type <> 'disbursement' and ti.customer_id = $id and t.is_deleted = 0 group by t.invoice,ti.company_id");
      break;
    case 'admin_form_create':
      $data['customers'] = $request->get_list("select ui.* from tbl_customers u inner join tbl_customers_info ui on ui.id = u.id inner join tbl_access a on a.id = u.access_id where u.is_deleted = 0");
      $data['forms'] = $request->get_form();
      $data['company'] = $request->get_company();
      break;


    case 'admin_account_list':
      $data['accounts'] = $request->get_list("SELECT x.id,x.parent_account_id,x.account_name,x.account_code,x.account_no,y.name as account_type,z.account_name as parent_name, x.is_deletable,x.is_deleted FROM tbl_account x inner join tbl_account_type y on (x.account_type_id = y.id and y.is_deleted = 0) left join tbl_account z on (z.id = x.parent_account_id and z.is_deleted = 0) where x.is_deleted = 0 order by x.created_date desc");
      break;
    case 'admin_bank_create':
    case 'admin_account_create':
      $data['account_type'] = $request->get_list("SELECT x.*,y.name as parent_name,count(z.account_type_id) as child from tbl_account_type x inner join tbl_account_type_category y on (y.id = x.account_type_category_id and y.is_deleted = 0) left join tbl_account z on z.account_type_id = x.id where x.is_deleted = 0 group by x.id order by x.account_type_category_id,x.order_index");
      $data['currency'] = $request->get_list("select * from tbl_currency where is_deleted = 0");
      break;
    case 'admin_bank_edit':
    case 'admin_account_edit':
      $data['account_type'] = $request->get_list("SELECT x.*,y.name as parent_name,count(z.account_type_id) as child from tbl_account_type x inner join tbl_account_type_category y on (y.id = x.account_type_category_id and y.is_deleted = 0) left join tbl_account z on z.account_type_id = x.id where x.is_deleted = 0 group by x.id order by x.account_type_category_id,x.order_index");
      $data['info'] = $request->get_one("SELECT * from tbl_account where id = $id");
      $data['currency'] = $request->get_list("select * from tbl_currency where is_deleted = 0");
      break;

    case 'admin_tax_list':
      $data['taxes'] = $request->get_list("SELECT * FROM tbl_tax x where x.is_deleted = 0 order by x.rate asc");
      break;
    case 'admin_tax_edit':
      $data['info'] = $request->get_one("SELECT * from tbl_tax where id = $id");
      break;

    case 'admin_bank_list':
      $data['banks'] = $request->get_list("SELECT x.id,x.parent_account_id,x.account_name,x.account_code,x.account_no,x.account_type_id,c.symbol,y.name as account_type,z.account_name as parent_name, x.is_deletable,x.is_deleted FROM tbl_account x inner join tbl_account_type y on (x.account_type_id = y.id and y.is_deleted = 0) left join tbl_account z on (z.id = x.parent_account_id and z.is_deleted = 0) inner join tbl_currency c on (c.id = x.currency_id and c.is_deleted = 0) where x.is_deleted = 0 and x.account_type_id in (3,4,9) order by x.created_date desc");
      break;

    case 'customer_register':
      $data['gender_list'] = $request->get_list("select id,UPPER(gender) as 'gender' from tbl_gender");
      break;
    case 'customer_edit':
      $data['profile'] = $request->get_one("select g.gender,UPPER(a.name) as 'access',ui.*,u.* from tbl_users u inner join tbl_users_info ui on ui.id = u.id inner join tbl_access a on a.id = u.access_id inner join tbl_gender g on g.id = ui.gender_id WHERE u.id = " . $id);
      $data['gender_list'] = $request->get_list("select id,UPPER(gender) as 'gender' from tbl_gender");
      break;
    case 'users':
      $data['users'] = $request->get_list("select g.gender,UPPER(a.name) as 'access',ui.*,u.* from tbl_users u inner join tbl_users_info ui on ui.id = u.id inner join tbl_access a on a.id = u.access_id inner join tbl_gender g on g.id = ui.gender_id and u.is_deleted = 0 where u.access_id != 3");
      break;
    case 'user_register':
      $data['access_list'] = $request->get_list("select id,UPPER(name) as 'access' from tbl_access where id != 3");
      $data['gender_list'] = $request->get_list("select id,UPPER(gender) as 'gender' from tbl_gender");
      break;
    case 'user_edit':
      $data['profile'] = $request->get_one("select g.gender,UPPER(a.name) as 'access',ui.*,u.* from tbl_users u inner join tbl_users_info ui on ui.id = u.id inner join tbl_access a on a.id = u.access_id inner join tbl_gender g on g.id = ui.gender_id WHERE u.id = " . $id);
      $data['access_list'] = $request->get_list("select id,UPPER(name) as 'access' from tbl_access where id != 1");
      $data['gender_list'] = $request->get_list("select id,UPPER(gender) as 'gender' from tbl_gender");
      break;
    case 'user_view':
      $data['profile'] = $request->get_one("select g.gender,UPPER(a.name) as 'access',ui.*,u.* from tbl_users u inner join tbl_users_info ui on ui.id = u.id inner join tbl_access a on a.id = u.access_id inner join tbl_gender g on g.id = ui.gender_id WHERE u.id = " . $id);
      $data['access_list'] = $request->get_list("select id,UPPER(name) as 'access' from tbl_access");
      $data['gender_list'] = $request->get_list("select id,UPPER(gender) as 'gender' from tbl_gender");
      break;
    case 'categories':
      $data['categories'] = $request->get_list("select * from tbl_category where is_deleted = 0");
      break;
    case 'category_edit':
      $data['category'] = $request->get_one("select * from tbl_category c WHERE is_deleted = 0 and c.id = " . $id);
      break;
    case 'products':
      $data['category_list'] = $request->get_list("select id,UPPER(name) as 'category' from tbl_category where is_deleted = 0");
      $data['products'] = $request->get_list("select c.name as category_name,p.*,concat('(ID#',i.id,') ',i.last_name,', ',i.first_name) as created_by from tbl_product p left join tbl_users_info i on i.id = p.created_by inner join tbl_category c on c.id = p.category_id where p.is_deleted = 0");
      break;
    case 'product_add':
      $data['category_list'] = $request->get_list("select id,UPPER(name) as 'category' from tbl_category where is_deleted = 0");
      break;
    case 'product_edit':
      $data['category_list'] = $request->get_list("select id,UPPER(name) as 'category' from tbl_category where is_deleted = 0");
      $data['product'] = $request->get_one("select * from tbl_product p WHERE is_deleted = 0 and p.id = " . $id);
      break;
    case 'inventory':
      $data['inventory'] = $request->get_list("select i.qty,p.* from tbl_product p inner join tbl_inventory i on i.product_id = p.id where is_deleted = 0");
      break;
    case 'inventory_edit':
      $data['category_list'] = $request->get_list("select id,UPPER(name) as 'category' from tbl_category where is_deleted = 0");
      $data['product'] = $request->get_one("select p.*,i.qty from tbl_product p left join tbl_inventory i on i.product_id = p.id WHERE p.is_deleted = 0 and p.id = " . $id);
      $data['product_history'] = $request->get_list("select h.*,concat('(ID#',i.id,') ',i.last_name,', ',i.first_name) as created_by from tbl_inventory_history h left join tbl_users_info i on i.id = h.created_by where h.product_id =" . $id . " order by h.date_created desc");
      break;
    case 'login_1':
      $data['gender_list'] = $request->get_list("select id,UPPER(gender) as 'gender' from tbl_gender");
      break;

    case 'shop':
      $where = '';
      $where .= ($id == 'all') ? '' : "and p.category_id = $id";
      $data['tag'] = ($id != 'all') ? "Product " . $request->get_one("select UPPER(name) as category from tbl_category where id = $id")->category : 'All Products';
      $data['products'] = $request->get_list("select * from tbl_product");
      $data['inventory'] = $request->get_list("select i.qty,p.* from tbl_product p inner join tbl_inventory i on i.product_id = p.id where 1 = 1 and p.is_deleted = 0 $where");
      break;
    case 'admin_profile':
      $data['gender_list'] = $request->get_list("select id,UPPER(gender) as 'gender' from tbl_gender");
      $data['profile'] = $request->get_one("select g.gender,UPPER(a.name) as 'access',ui.*,u.* from tbl_users u inner join tbl_users_info ui on ui.id = u.id inner join tbl_access a on a.id = u.access_id inner join tbl_gender g on g.id = ui.gender_id WHERE u.id = " . $_SESSION['user']->id);
      break;
    case 'transactions':
      $data['transactions'] = $request->get_list("select t.date_updated, s.id as `seller_id`, b.id as `buyer_id`, p.id as `product_id`,t.id,t.price as `total_price`,t.qty,i.invoice,p.name,p.price,t.status_id,ss.status,concat('(ID#',b.id,') ',b.last_name,', ',b.first_name) as buyer_name ,concat('(ID#',s.id,') ',s.last_name,', ',s.first_name) as seller_name FROM tbl_transactions t left join tbl_invoice i on i.id = t.invoice_id inner join tbl_product p on p.id = t.product_id inner join tbl_users_info b on b.id = t.buyer_id left join tbl_users_info s on s.id = t.seller_id inner join tbl_status ss on ss.id = t.status_id where t.status_id > 1 and t.is_deleted = 0 and p.is_deleted = 0 order by t.date_updated desc");
      break;
    case 'transaction_view':
      $transaction = $request->get_one("select i.invoice,upper(s.status) as `status`,concat('(ID#',b.id,') ',b.last_name,', ',b.first_name) as buyer_name, concat('(ID#',su.id,') ',su.last_name,', ',su.first_name) as seller_name, t.* from tbl_transactions t inner join tbl_invoice i on i.id = t.invoice_id inner join tbl_status s on s.id = t.status_id inner join tbl_users_info b on b.id = t.buyer_id left join tbl_users_info su on su.id = t.seller_id where t.id = " . $id);

      $data['product'] = $request->get_one("select * from tbl_product WHERE  id = " . $transaction->product_id);
      $data['status_history'] = $request->get_list('select sh.date_created,sh.id,UPPER(s.status) as `status`,u.id as user_id,concat("(ID#",u.id,") ",u.last_name,", ", u.first_name) as `user`,ac.access_id FROM tbl_status_history sh inner join tbl_status s on s.id = sh.status_id inner join tbl_users_info u on u.id = sh.created_by inner join tbl_users ac on ac.id = sh.created_by where sh.transaction_id = ' . $id . ' order by date_created desc');
      $data['transaction'] = $transaction;
      break;
    case 'orders':
      $data['orders'] = $request->get_list("select ps.name as `paid_status`,t.date_updated, s.id as `seller_id`, b.id as `buyer_id`, t.id,sum(IF(t.status_id in (2,3,4), t.price, 0)) as `total_price`,sum(IF(t.status_id in (2,3,4), t.qty, 0)) as qty,i.invoice,p.name,p.price,i.status_id,concat('(ID#',b.id,') ',b.last_name,', ',b.first_name) as buyer_name ,concat('(ID#',s.id,') ',s.last_name,', ',s.first_name) as seller_name,is.status as `status` FROM tbl_transactions t inner join tbl_invoice i on i.id = t.invoice_id inner join tbl_invoice_status `is` on `is`.id = i.status_id inner join tbl_product p on p.id = t.product_id inner join tbl_users_info b on b.id = t.buyer_id left join tbl_users_info s on s.id = t.seller_id inner join tbl_paid_status ps on ps.id = i.paid_status_id where t.status_id > 1 and t.is_deleted = 0 group by t.invoice_id order by t.date_updated desc");
      break;
    case 'orders_view':
      $main = $request->get_list("select t.invoice_id,t.date_updated,p.id as `product_id`,t.id,t.buyer_id,t.price as `total_price`,t.qty,i.invoice,p.name,p.price,t.status_id,ss.status,concat('(ID#',b.id,') ',b.last_name,', ',b.first_name) as buyer_name ,concat('(ID#',s.id,') ',s.last_name,', ',s.first_name) as seller_name FROM tbl_transactions t inner join tbl_invoice i on i.id = t.invoice_id inner join tbl_product p on p.id = t.product_id inner join tbl_users_info b on b.id = t.buyer_id left join tbl_users_info s on s.id = t.seller_id inner join tbl_status ss on ss.id = t.status_id where t.status_id > 1 and t.is_deleted = 0 and i.invoice = '$id' and p.is_deleted = 0 order by t.date_updated desc");
      $customer_id = reset($main)['buyer_id'];
      $invoice_id = reset($main)['invoice_id'];
      $data['transactions'] = $main;
      $data['customer'] = $request->get_one("select ui.*,u.* from tbl_users_info ui inner join tbl_users u on u.id = ui.id WHERE ui.id = " . $customer_id . " limit 1");
      $data['status_history'] = $request->get_list('select sh.date_created,sh.id,UPPER(s.status) as `status`,u.id as user_id,concat("(ID#",u.id,") ",u.last_name,", ", u.first_name) as `user`,ac.access_id FROM tbl_invoice_status_history sh inner join tbl_invoice_status s on s.id = sh.status_id inner join tbl_users_info u on u.id = sh.created_by inner join tbl_users ac on ac.id = sh.created_by where sh.invoice_id = ' . $invoice_id . ' order by id desc');
      $data['actual_invoice'] = $request->get_one("SELECT * FROM tbl_invoice where invoice = '$id' limit 1");
      break;
    case 'customer_view':
      $data['profile'] = $request->get_one("select g.gender,UPPER(a.name) as 'access',ui.*,u.* from tbl_users u inner join tbl_users_info ui on ui.id = u.id inner join tbl_access a on a.id = u.access_id inner join tbl_gender g on g.id = ui.gender_id WHERE u.id = " . $id);
      $data['access_list'] = $request->get_list("select id,UPPER(name) as 'access' from tbl_access");
      $data['gender_list'] = $request->get_list("select id,UPPER(gender) as 'gender' from tbl_gender");
      $tmp = array();
      $tmp_res = $request->get_list("select t.id,t.qty,s.status,t.date_updated,t.status_id,i.invoice, i.date_created as invoice_date,p.id as `product_id`,p.name,p.price as product_price from tbl_transactions t inner join tbl_status s on s.id = t.status_id inner join tbl_invoice i on i.id = t.invoice_id  inner join tbl_product p on p.id = t.product_id where t.is_deleted = 0 and p.is_deleted = 0 and t.status_id > 1 and buyer_id = '$id' order by t.date_created desc");
      foreach ($tmp_res as $res) {
        $tmp['invoice'][$res['invoice']][$res['id']] = $res;
      }
      $data['orders'] = $tmp;
      break;
      // Customers
    case 'cart':
      $data['cart'] = $request->get_list("select t.id,t.price as sum_price,t.qty,t.product_id,p.name,p.description,p.price from tbl_transactions t inner join tbl_product p on p.id = t.product_id where t.buyer_id = '$customer_id' and t.status_id = 1 and t.is_deleted = 0 and p.is_deleted = 0");
      break;
    case 'customer_profile':
      $data['gender_list'] = $request->get_list("select id,UPPER(gender) as 'gender' from tbl_gender");
      $data['profile'] = $request->get_one("select g.gender,UPPER(a.name) as 'access',ui.*,u.* from tbl_users u inner join tbl_users_info ui on ui.id = u.id inner join tbl_access a on a.id = u.access_id inner join tbl_gender g on g.id = ui.gender_id WHERE u.id = " . $_SESSION['user']->id);
      break;
    case 'customer_orders':
      $tmp = array();
      $tmp_res = $request->get_list("select t.id,t.qty,s.status,t.date_updated,t.status_id,i.invoice, i.date_created as invoice_date,is.status as `invoice_status`, p.id as `product_id`,p.name,p.price as product_price from tbl_transactions t inner join tbl_status s on s.id = t.status_id inner join tbl_invoice i on i.id = t.invoice_id  inner join tbl_product p on p.id = t.product_id inner join tbl_invoice_status `is` on is.id = i.status_id where t.is_deleted = 0 and t.status_id > 1 and buyer_id = '$customer_id' and p.is_deleted = 0 order by t.date_created desc");
      foreach ($tmp_res as $res) {
        $tmp['invoice'][$res['invoice']][$res['id']] = $res;
        $tmp['status'][$res['invoice']] = $res['invoice_status'];
      }
      $data['orders'] = $tmp;
      break;
    case 'customer_category':
      $data['category_list'] = $request->get_list("select id,UPPER(name) as 'category' from tbl_category where is_deleted = 0");
      break;
  }
  echo get_contents(page_url($page), $data);
  die;
} else {
  echo get_contents(page_url('denied'));
  die;
}
