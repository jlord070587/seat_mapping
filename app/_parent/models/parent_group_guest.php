<?php
App::import('Model','AppSub');
class ParentGroupGuest extends AppSub
{
	public $name = 'ParentGroupGuest';
	public $useTable = 'groups_guests';
	
	/**
	 * 現ユーザー・テンプレートに紐付く招待客IDを返す
	 * @return array
	 */
	public function getRelatedUserIds()
	{
		$conditions = array(
			'GroupGuest.user_id =' => $this->_user_id,
			'GroupGuest.template_type =' => $this->_u_info['template_type'],
		);
		$fields = array('GroupGuest.guest_id');
		return $this->find('list',compact('conditions','fields'));
	}
	
	public function registRelation($post)
	{
		try{
			$this->begin();
			$conditions = array(
				'GroupGuest.guest_id =' => $post['id'],
				'GroupGuest.user_id =' => $this->_user_id,
				'GroupGuest.template_type =' => $this->_u_info['template_type'],
			);
			$bool = $this->deleteAll($conditions,$cascade = false);
			if($post['gid']!='null'){
				$rgst['GroupGuest'] =  array(
					'group_id' => $post['gid'],'guest_id' => $post['id'],
					'user_id' => $this->_user_id,'template_type' => $this->_u_info['template_type']
				);
				$this->save($rgst);
			}
			$this->commit();
			return true;
		}catch(Exception $e){
			$this->rollback();
			return false;
		}
	}
	public function resetRelation()
	{
		try{
			$this->begin();
			$conditions = array(
				'GroupGuest.user_id =' => $this->_user_id,
				'GroupGuest.template_type =' => $this->_u_info['template_type'],
			);
			$this->deleteAll($conditions,$cascade = false);
			$this->commit();
			return true;
		}catch(Exception $e){
			$this->rollback();
			return false;
		}
	}
}
?>