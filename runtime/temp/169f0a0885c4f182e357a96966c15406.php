<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:70:"D:\phpStudy\WWW\zgmrw\public/../application/admin\view\chat\index.html";i:1516347336;}*/ ?>
<div id="chat-dialog">
    <div class="set-out">
        <ul>
            <li><a href="javascript:;"><i class="layui-icon">&#xe61a;</i></a></li>
            <li><a href="javascript:;" class="go-out-chat"><i class="layui-icon">&#x1006;</i></a></li>
        </ul>
    </div>

    <div class="chat-content">

        <div class="chat-c-header">
            <div class="chat-c-header-logo">
                <img src="<?php echo $user['am_logo']; ?>" alt="">
            </div>
            <div class="chat-c-header-info">
                <p class="u-nickname"><?php echo $user['am_nickname']; ?></p>
                <p class="u-message">我是简介</p>
            </div>
            <div class="both"></div>
        </div>
        <div class="chat-c-body">
            <div class="f-group-list">
                <ul>
                    <?php if(is_array($friends) || $friends instanceof \think\Collection || $friends instanceof \think\Paginator): $i = 0; $__LIST__ = $friends;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li class="group-list  group-<?php echo $vo['id']; ?>"><i class="layui-icon group-conf-r">&#xe623;</i><?php echo $vo['name']; ?> <span
                                class="f-num info-right"><?php echo count($vo['friends']); ?></span>
                        </li>
                        <div class="friend-list display-none">
                            <ul>
                                <?php if(is_array($vo['friends']) || $vo['friends'] instanceof \think\Collection || $vo['friends'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['friends'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;if(!(empty($v['am_nickname']) || (($v['am_nickname'] instanceof \think\Collection || $v['am_nickname'] instanceof \think\Paginator ) && $v['am_nickname']->isEmpty()))): ?>
                                    <li class="f-list"><a href="javascript:;">
                                        <div class="friend-content">
                                            <div class="chat-c-header-logo">
                                                <img src="http://t.cn/RCzsdCq" alt="">
                                            </div>
                                            <div class="chat-c-header-info">
                                                <p class="u-nickname <?php if($v['am_log_status'] == '1'): ?>success-color<?php endif; ?>"><?php echo $v['am_nickname']; if($v['messages'] > '0'): ?><span class="layui-badge-dot info-right"></span><?php endif; ?>
                                                </p>
                                                <p class="u-message">我是简介 <?php if($v['messages'] > '0'): ?><span class="info-right"><?php
                                                         if( isset($v['send_time']))
                                                         {
                                                             echo date('H:i', strtotime($v['send_time']) );
                                                         }else{
                                                            echo '00:00';
                                                         }
                                                    ?></span><?php endif; ?></p>
                                            </div>
                                        </div>
                                    </a>
                                        <div class="both"></div>
                                    </li>
                                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                        </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>

            </div>
        </div>
        <div class="chat-c-footer">
            <ul>
                <li><a href="javascript:;"><i class="layui-icon">&#xe65f;</i></a></li>
                <li><a href="javascript:;"><i class="layui-icon">&#xe615;</i></a></li>
                <li><a href="javascript:;"><i class="layui-icon">&#xe654;</i></a></li>
            </ul>
        </div>
    </div>
</div>