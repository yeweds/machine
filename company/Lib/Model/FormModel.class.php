 <?php 
class FormModel extends Model 
{
	protected $autoCreateTimestamps = array('postdate');
	protected $_validate=array(
		array('username','require','username must',0,'','all'),
		array('password','require','password must',0,'','add'),
	);	
	
	
}
?>