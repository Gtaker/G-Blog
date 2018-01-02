<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- 引入样式 -->
    <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
    <script src="https://unpkg.com/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/element-ui/lib/index.js"></script>
</head>
<body>
<div id="card">
    <el-card class="box-card">
        <div slot="header" class="clearfix">
            <span class="title"><?php echo $title;?></span>
        </div>
        <div class="text item">
            <?php echo $message;?>
        </div>
    </el-card>
</div>
</body>

<style>
    #card {
        margin: 0 auto;
        width: 880px;
        height: 100px;
    }

    .title {
        font-weight: bold;
        text-align: center;
        font-size: 38px;
    }

    .text {
        font-size: 28px;
        color: #909399;
    }

    .item {
        margin-bottom: 18px;
    }

    .clearfix {
        text-align: center;
    }

    .clearfix:before,
    .clearfix:after {
        display: table;
        content: "";
    }

    .clearfix:after {
        clear: both
    }

    .box-card {
        width: 880px;
        line-height: 45px;
    }
</style>
<script>
    new Vue({
        el: '#card',
        data: function () {
            return {
                visible: false
            }
        }
    })
</script>
</html>