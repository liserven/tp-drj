<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"D:\phpStudy\WWW\drj\public/../application/admin\view\consumers\getbywhere.html";i:1525056025;}*/ ?>
<table class="layui-table" style="width: 100%; border: 1px solid #eee">
    <colgroup>
        <col width="50">
        <col width="50">
    </colgroup>
    <thead>
    <tr>
        <th data-field="name" class="col-md-4">
            <div class="layui-table-cell">
                <span>地区名称</span>
            </div>
        </th>
        <th data-field="type"  class="col-md-4">
            <div class="layui-table-cell"><span>客户总量</span></div>
        </th>
        <th data-field="type"  class="col-md-4">
            <div class="layui-table-cell"><span>排名</span></div>
        </th>
    </tr>
    </thead>
    <tbody class="">
    <?php if(is_array($page) || $page instanceof \think\Collection || $page instanceof \think\Paginator): $i = 0; $__LIST__ = $page;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <tr data-index="0" class="tbody_content" data-id="<?php echo $vo['id']; ?>">
            <td   class="col-md-4">
                <div class="layui-table-cell" style="width: 33%;"><?php echo $vo['name']; ?></div>
            </td>
            <td  style="width: 33%;">
                <div class="layui-table-cell"><?php echo $vo['totals']; ?></div>
            </td>
            <td  style="width: 33%;">
                <div class="layui-table-cell" style="width: 33%;">
                    <span class="layui-badge <?php echo $key+1<=3?'layui-badge' : 'layui-bg-gray'; ?>"><?php echo $key+1; ?></span>
                </div>
            </td>
        </tr>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
    <tfoot>
    <tr>
        <td colspan="13"><?php echo $page->render();; ?></td>
    </tr>
    </tfoot>
</table>