<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/16
 * Time: 14:33
 */

namespace App\Admin\Controllers;


use App\Admin\Model\AdminUserModel;
use App\Admin\Model\UserModel;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Grid;
use Illuminate\Support\Facades\DB;

class UserController extends AdminController
{
    protected $title= '用户管理';

    public function grid(){
        //DB::
        //var_dump($this->input());
        $grid = new Grid(new UserModel());
        $grid->column('id','id')->sortable();
        $grid->column('name','名称');
        $grid->column('email','邮箱');
        $grid->column('level','等级');
        $grid->column('level_score','等级积分')->sortable();
        $grid->column('left_reward','赏金')->sortable();
        $grid->column('left_prize','奖励')->sortable();
        $grid->column('phone','电话');
        $grid->column('created_at','注册时间');//->date('Y-m-d');
        $grid->column('updated_at','最后更新时间');//->date('Y-m-d');
        $grid->column('delete_at','封禁时间');
        $grid->column('parent_id','上级id');
        $grid->filter(function ($filters){
            $filters->column(1/2,function ($filter){
                $filter->like('name','名称');
                $filter->equal('email','邮箱');
               /* $filter->group('level', function ($group) {
                    $group->gt('大于');
                    $group->lt('小于');
                    $group->nlt('不小于');
                    $group->ngt('不大于');
                    $group->equal('等于');
                });*/

                $filter->between('level','用户等级');
            });
            $filters->column(1/2,function ($filter){

                $filter->between('created_at','注册时间')->datetime();

                $filter->equal('parent_id','上级id');
            });

        });
        $grid->paginator(10);
       // var_dump($grid);
       return   $grid;
    }

    public function detail($id){

    }

    public function form(){

    }


}