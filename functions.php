<?php

if(file_exists('../vendor/autoload.php'))
{
    require '../vendor/autoload.php';
}

require '../libs/JwtAuth.php';
require '../libs/ArrayHelper.php';
require '../libs/Session.php';
require '../libs/Database.php';
require '../libs/Whatsapp.php';

$config = require '../config/main.php';

function app($key = false)
{
    $conn  = conn();
    $db    = new Database($conn);
    $app   = $db->single('application');

    if(!$key)
        return $app;
    return $app->{$key};
}

function get_role($user_id)
{
    $conn  = conn();
    $db    = new Database($conn);

    $query = "SELECT user_roles.*, roles.name FROM `user_roles` JOIN roles ON roles.id = user_roles.role_id WHERE user_id=$user_id";
    $db->query = $query;
    return $db->exec('single');
}

function get_roles($user_id)
{
    $conn  = conn();
    $db    = new Database($conn);

    $query = "SELECT user_roles.*, roles.name FROM `user_roles` JOIN roles ON roles.id = user_roles.role_id WHERE user_id=$user_id";
    $db->query = $query;
    return $db->exec('all');
}

function get_allowed_routes($user_id)
{
    $conn  = conn();
    $db    = new Database($conn);

    $query = "SELECT role_routes.route_path FROM `user_roles` JOIN roles ON roles.id = user_roles.role_id JOIN role_routes ON role_routes.role_id = user_roles.role_id WHERE user_id=$user_id";
    $db->query = $query;
    return $db->exec('all');
}

function get_allowed_routes_role($role)
{
    $conn  = conn();
    $db    = new Database($conn);

    $query = "SELECT role_routes.route_path FROM roles JOIN role_routes ON role_routes.role_id = roles.id WHERE roles.name='$role'";
    $db->query = $query;
    return $db->exec('all');
}

function generated_menu($user_id)
{
    $menu = config('menu')['menu'];
    $icon = config('menu')['icon'];
    $generated = "";
    $r = get_route();

    foreach($menu as $key => $route)
    {
        if(is_array($route))
        {
            $dropdown = '';
            $allowed = false;
            $active = false;

            foreach($route as $label => $submenu)
            {
                if(!is_allowed($submenu,$user_id)) continue;
                $allowed = true;
                $start_route = str_replace('/index','',$submenu);
                if(!$active)
                    $active = startWith($r, $start_route);
                $dropdown .= '<li class="'.(startWith($r, $start_route)?'active':'').'">
                                <a href="index.php?r='.$submenu.'">
                                    <span class="sub-item">'.ucwords($label).'</span>
                                </a>
                            </li>';
            }

            $dropdown = '<li class="nav-item '.($active?'active submenu':'').'">
                            <a data-toggle="collapse" href="#'.$key.'" aria-expanded="'.($active?'true':'').'">
                                <i class="'.$icon[$key].'"></i>
                                <p>'.ucwords($key).'</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse '.($active?'show':'').'" id="'.$key.'">
                                <ul class="nav nav-collapse">
                                '.$dropdown.'
                                </ul>
                            </div>
                        </li>';
            if(!$allowed) continue;
            $generated .= $dropdown;
        }
        else
        {
            if(!is_allowed($route,$user_id)) continue;
            $start_route = str_replace('/index','',$route);
            $active = startWith($r, $start_route);
            $generated .= '<li class="nav-item '.($active?'active':'').'">
                                <a href="index.php?r='.$route.'">
                                    <i class="'.$icon[$key].'"></i>
                                    <p>'.ucwords($key).'</p>
                                </a>
                            </li>';
        }
    }

    return $generated;
}

function is_allowed($path, $user_id)
{
    $ret = false;
    $allowed_routes = get_allowed_routes($user_id);
    foreach($allowed_routes as $route)
    {
        $route_path = $route->route_path;
        if(endsWith($route_path, '*'))
        {
            $route_path = str_replace('*','',$route_path);
            if(startWith($path, $route_path))
            {
                $ret = true;
                break;
            }
        }
        elseif($path == $route_path)
        {
            $ret = true;
            break;
        }
    }
    return $ret;
}

function is_allowed_roles($path, $roles)
{
    $ret = false;
    $allowed_routes = [];
    foreach($roles as $role)
        $allowed_routes = array_merge($allowed_routes, get_allowed_routes_role($role));

    foreach($allowed_routes as $route)
    {
        $route_path = $route->route_path;
        if(endsWith($route_path, '*'))
        {
            $route_path = str_replace('*','',$route_path);
            if(startWith($path, $route_path))
            {
                $ret = true;
                break;
            }
        }
        elseif($path == $route_path)
        {
            $ret = true;
            break;
        }
    }
    return $ret;
}

function config($key = false)
{
    global $config;
    if($key) return $config[$key];
    return $config;
}

function conn(){
    $database = config('database');
    $type = $database['driver'];
    if($type=='PDO')
    {
        // Connect using UNIX sockets
        if($database['socket'])
        {
            $dsn = sprintf(
                'mysql:dbname=%s;unix_socket=%s',
                $database['dbname'],
                $database['socket']
            );
        }
        else
        {
            $dsn = sprintf(
                'mysql:dbname=%s;host=%s',
                $database['dbname'],
                $database['host']
            );
        }

        // Connect to the database.
        $conn = new PDO($dsn, $database['username'], $database['password']);

        return $conn;
    }
    else
    {
        return new mysqli(
            $database['host'],
            $database['username'],
            $database['password'],
            $database['dbname'],
            $database['port'],
            $database['socket']
        );
    }

}

function load_page($page)
{

    $action = load_action($page);
    $data = !is_array($action) ? [] : $action;
    load_templates($page,$data);
    return;
}

function load_action($action)
{
    if(file_exists('../actions/'.$action.'.php'))
        return require '../actions/'.$action.'.php';
    return [];
}

function load_templates($template, $data = [], $flush = false)
{    
    if(file_exists('../templates/'.$template.'.php'))
    {
        extract($data);
        if($flush)
            ob_start();

        require '../templates/'.$template.'.php';
        
        if($flush)
            return ob_get_clean();
    }
    else
        require '../templates/errors/404.php';
}

function startWith($str, $compare)
{
    return substr($str, 0, strlen($compare)) === $compare;
}

function base_url()
{
    return url(); // config('base_url');
}

function url(){
    $server_name = $_SERVER['SERVER_NAME'];

    if (!in_array($_SERVER['SERVER_PORT'], [80, 443])) {
        $port = ":$_SERVER[SERVER_PORT]";
    } else {
        $port = '';
    }

    if (!empty($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) == 'on' || $_SERVER['HTTPS'] == '1')) {
        $scheme = 'https';
    } else {
        $scheme = 'http';
    }
    return $scheme.'://'.$server_name.$port;
}

function auth()
{
    // mode jwt
    if(config('auth') == 'jwt')
        return JwtAuth::get();
    if(config('auth') == 'session')
        return Session::get();
}

function stringContains($string,$val){
    if (strpos($string, $val) !== false) {
        return true;
    }

    return false;
}

function arrStringContains($string,$arr){

    $result = [];

    for($i = 0; $i < count($arr);$i++){
       $result[] = stringContains($string,$arr[$i]);
    }

    return in_array(true,$result);
}

function request($method = false)
{
    if(!$method)
        return $_SERVER['REQUEST_METHOD'];

    if(strtolower($method) == 'post')
        return $_POST;

    return $_GET;
}

function get_route()
{
    return $_GET['r']??config('default_page');
}

function startsWith( $haystack, $needle ) {
    $length = strlen( $needle );
    return substr( $haystack, 0, $length ) === $needle;
}

function endsWith( $haystack, $needle ) {
   $length = strlen( $needle );
   if( !$length ) {
       return true;
   }
   return substr( $haystack, -$length ) === $needle;
}

function set_flash_msg($data)
{
    $_SESSION['flash'] = $data;
}

function get_flash_msg($key)
{
    if(isset($_SESSION['flash'][$key]))
    {
        $message = $_SESSION['flash'][$key];
        unset($_SESSION['flash'][$key]);
        return $message;
    }

    return false;
}

/**
 * Wrapper for easy cURLing
 *
 * @author Viliam Kopecký
 *
 * @param string HTTP method (GET|POST|PUT|DELETE)
 * @param string URI
 * @param mixed content for POST and PUT methods
 * @param array headers
 * @param array curl options
 * @return array of 'headers', 'content', 'error'
 */
function simple_curl($uri, $method='GET', $data=null, $curl_headers=array(), $curl_options=array()) {
	// defaults
	$default_curl_options = array(
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_HEADER => true,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_TIMEOUT => 3,
	);
	$default_headers = array();

	// validate input
	$method = strtoupper(trim($method));
	$allowed_methods = array('GET', 'POST', 'PUT', 'DELETE');

	if(!in_array($method, $allowed_methods))
		throw new \Exception("'$method' is not valid cURL HTTP method.");

	if(!empty($data) && !is_string($data))
		throw new \Exception("Invalid data for cURL request '$method $uri'");

	// init
	$curl = curl_init($uri);

	// apply default options
	curl_setopt_array($curl, $default_curl_options);

	// apply method specific options
	switch($method) {
		case 'GET':
			break;
		case 'POST':
			if(!is_string($data))
				throw new \Exception("Invalid data for cURL request '$method $uri'");
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			break;
		case 'PUT':
			if(!is_string($data))
				throw new \Exception("Invalid data for cURL request '$method $uri'");
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			break;
		case 'DELETE':
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
			break;
	}

	// apply user options
	curl_setopt_array($curl, $curl_options);

	// add headers
	curl_setopt($curl, CURLOPT_HTTPHEADER, array_merge($default_headers, $curl_headers));

	// parse result
	$raw = rtrim(curl_exec($curl));
	$lines = explode("\r\n", $raw);
	$headers = array();
	$content = '';
	$write_content = false;
	if(count($lines) > 3) {
		foreach($lines as $h) {
			if($h == '')
				$write_content = true;
			else {
				if($write_content)
					$content .= $h."\n";
				else
					$headers[] = $h;
			}
		}
	}
	$error = curl_error($curl);

	curl_close($curl);

	// return
	return array(
		'raw' => $raw,
		'headers' => $headers,
		'content' => $content,
		'error' => $error
	);
}

function count_total($items)
{
    $total = 0;
    foreach($items as $item)
        $total += $item['subtotal'];

    return $total;
}

function count_visitors($date = false)
{
    if(!$date) $date = date('Y-m-d');
    $query = "SELECT COUNT(*) as JUMLAH FROM visitors WHERE created_at LIKE '%$date%'";

    $conn  = conn();
    $db    = new Database($conn);
    $db->query = $query;
    return $db->exec('single')->JUMLAH;
}

function count_borrowers($date = false)
{
    if(!$date) $date = date('Y-m-d');
    $query = "SELECT COUNT(*) as JUMLAH FROM book_takes WHERE taken_date LIKE '%$date%'";

    $conn  = conn();
    $db    = new Database($conn);
    $db->query = $query;
    return $db->exec('single')->JUMLAH;
}

function terpakai($tree, $year)
{
    $amount = 0;
    foreach($tree->getRootNodes() as $root)
    {
        $amount += sisaBudget($root->id,$year);
    }

    return $amount;
}

function render_tree_on_row($tree, $sources, $year)
{
    $rows = "";
    foreach($tree->getRootNodes() as $root):
    $rows .= "<tr><td>$root->code</td><td class='text-nowrap'><b>$root->name</b><br><i>$root->description</i></td>";
        foreach($sources as $source):
            $rows .= '<td><input type="number" class="form-control" name="budgets['.$root->id.']['.$source->id.']" value="'.getBudget($root->id, $source->id, $year).'"></td>';
        endforeach;
    $rows .= "</tr>";

    $rows .= render_descendants($root, $sources, $year, 1);
    endforeach;

    return $rows;
}

function render_descendants($node, $sources, $year, $gen)
{
    $rows = "";
    foreach($node->getChildren() as $descendant):
    $space = str_repeat('&nbsp;', $gen*8);
    $rows .= "<tr><td>$descendant->code</td><td class='text-nowrap'>".$space.' - '.$descendant->name."<br>".$space."<span class='text-xs'><i>".$descendant->description."</i></span></td>";
        foreach($sources as $source):
            $rows .= '<td><input type="number" class="form-control" name="budgets['.$descendant->id.']['.$source->id.']" value="'.getBudget($descendant->id, $source->id, $year).'"></td>';
        endforeach;
    $rows .= "</tr>";

    $rows .= render_descendants($descendant, $sources, $year, $gen+1);
    endforeach;

    return $rows;
}

function render_tree_on_row_detail($tree, $sources, $year, $detail = false)
{
    $rows = "";
    foreach($tree->getRootNodes() as $root):

        $item_link = "";
        if(!$root->hasChildren() && !$detail)
        {
            $item_link = "<br><a href='index.php?r=budget-items/index&budget_id=$root->id'>Rincian</a>";
        }
        $rows .= "<tr><td>$root->code</td><td><b class='text-nowrap'>$root->name</b><br><i>$root->description</i>$item_link</td>";
        foreach($sources as $source):
            $rows .= '<td class="text-nowrap">Rp. '.number_format(getBudget($root->id,$source->id,$year)).'</td>';
        endforeach;
        $rows .= '<td class="text-nowrap">Rp. '.number_format(totalBudget($root->id,$year)).'</td>';
        $rows .= '<td class="text-nowrap">Rp. '.number_format(sisaBudget($root->id,$year)).'</td>';
        if($detail)
        {
            $rows .= '<td class="text-nowrap">Rp. '.number_format(totalBudget($root->id,$year)-sisaBudget($root->id,$year)).'</td>';
        }
        $rows .= "</tr>";
        if($root->hasChildren())
        {
            $rows .= render_descendants_detail($root, $sources, $year, 1, $detail);
        }
        else
        {
            $rows .= render_item($root, $sources, $year, 1);
        }
    endforeach;

    return $rows;
}

function render_descendants_detail($node, $sources, $year, $gen, $detail = false)
{
    $rows = "";
    foreach($node->getChildren() as $descendant):
        $space = str_repeat('&nbsp;', $gen*8);
        $item_link = "";
        if(!$descendant->hasChildren() && !$detail)
        {
            $item_link = "<br>$space<a href='index.php?r=budget-items/index&budget_id=$descendant->id'>Rincian</a>";
        }
        $rows .= "<tr><td>$descendant->code</td><td class='text-nowrap'>".$space.' - '.$descendant->name."<br>".$space."<span class='text-xs'><i>".$descendant->description."</i></span>$item_link</td>";
        foreach($sources as $source):
            $rows .= '<td class="text-nowrap">Rp. '.number_format(getBudget($descendant->id,$source->id,$year)).'</td>';
        endforeach;
        $rows .= '<td class="text-nowrap">Rp. '.number_format(totalBudget($descendant->id,$year)).'</td>';
        $rows .= '<td class="text-nowrap">Rp. '.number_format(sisaBudget($descendant->id,$year)).'</td>';
        if($detail) 
        {
            $rows .= '<td class="text-nowrap">Rp. '.number_format(totalBudget($descendant->id,$year)-sisaBudget($descendant->id,$year)).'</td>';
        }
    $rows .= "</tr>";
    if($descendant->hasChildren())
    {
        $rows .= render_descendants_detail($descendant, $sources, $year, $gen+1, $detail);
    }
    else
    {
        if($detail)
        {
            $rows .= render_item($descendant, $sources, $year, $gen);
        }
    }
    endforeach;

    return $rows;
}

function render_item($node, $sources, $year, $gen)
{
    $conn  = conn();
    $db    = new Database($conn);

    $budget = $db->single('budgets',[
        'activity_id' => $node->id,
        'year_id'     => $year
    ]);

    // find date range
    $items = [];
    if(
        isset($_GET['from']) && !empty($_GET['from']) &&
        isset($_GET['to']) && !empty($_GET['to'])
    )
    {
        $db->query = "SELECT * FROM budget_items WHERE budget_id = $budget->id AND created_at BETWEEN '$_GET[from] 00:00:00' AND '$_GET[to] 23:59:59'";
        $items = $db->exec('all');
    }
    else
    {
        $items = $db->all('budget_items',[
            'budget_id' => $budget->id
        ]);
    }
    
    $rows = "";
    foreach($items as $item)
    {
        $space = str_repeat('&nbsp;', $gen*8);
        $rows .= "<tr><td><td>".$space.' - '.$item->name."<br>".$space."<span class='text-xs'><i>".$item->description."</i></span></td>";
        foreach($sources as $source):
            $rows .= '<td></td>';
        endforeach;
        $rows .= '<td class="text-nowrap">Rp. <i>'.number_format($item->amount).'</i></td>';
        $rows .= '<td></td>';
        $rows .= '<td></td>';
        $rows .= '</tr>';
    }

    return $rows;
}

function getBudget($activity,$source_id,$year)
{
    $conn  = conn();
    $db    = new Database($conn);

    $budget = $db->single('budgets',[
        'activity_id' => $activity,
        'year_id'     => $year
    ]);

    $source = $db->single('budget_sources',[
        'budget_id' => $budget->id,
        'source_id' => $source_id
    ]);

    return $source ? $source->amount : 0;
}

function totalBudget($activity, $year)
{
    $conn  = conn();
    $db    = new Database($conn);

    $budget = $db->single('budgets',[
        'activity_id' => $activity,
        'year_id'     => $year
    ]);

    $db->query = "SELECT SUM(amount) as total FROM budget_sources WHERE budget_id = $budget->id";
    $source = $db->exec('single');

    return $source->total;
}

function sisaBudget($activity, $year)
{
    $conn  = conn();
    $db    = new Database($conn);

    $activities = $db->all('activities');
    $activities = json_decode(json_encode($activities),1);

    $activities = array_map(function($d){
        $d['id'] = (int) $d['id'];
        $d['parent'] = (int) $d['parent_id'];
        return $d;
    }, $activities);

    $tree = new BlueM\Tree($activities);

    $node = $tree->getNodeById($activity);

    $count_budget = countBudget($node, $year);

    // return totalBudget($activity, $year) - $count_budget;
    return $count_budget;
}

function countBudget($node, $year)
{
    $conn  = conn();
    $db    = new Database($conn);

    $counter = 0;
    if($node->hasChildren())
    {
        $childrens = $node->getChildren();
        foreach($childrens as $descendant)
        {
            $budget = $db->single('budgets',[
                'activity_id' => $descendant->id,
                'year_id'     => $year
            ]);
        
            
            $db->query = "SELECT SUM(amount) as total FROM budget_sources WHERE budget_id = $budget->id";
            $source = $db->exec('single');
            $counter += countBudget($descendant, $year);
        }
    }
    else
    {
        $items = [];
        $budget = $db->single('budgets',[
            'activity_id' => $node->id,
            'year_id'     => $year
        ]);
        if(
            isset($_GET['from']) && !empty($_GET['from']) &&
            isset($_GET['to']) && !empty($_GET['to'])
        )
        {
            $db->query = "SELECT SUM(amount) as total FROM budget_items WHERE budget_id = $budget->id AND created_at BETWEEN '$_GET[from] 00:00:00' AND '$_GET[to] 23:59:59'";
            $items = $db->exec('single');
        }
        else
        {
            $db->query = "SELECT SUM(amount) as total FROM budget_items WHERE budget_id = $budget->id";
            $items = $db->exec('single');
        }

        $counter += $items ? $items->total : 0;
    }

    return $counter;

}