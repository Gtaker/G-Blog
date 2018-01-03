<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://unpkg.com/element-ui@2.0.10/lib/theme-chalk/index.css">
    <script src="https://unpkg.com/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/element-ui@2.0.10/lib/index.js"></script>
</head>
<body>
<div id="card">
    <el-card class="box-card">
        <div slot="header" class="clearfix">
            <span class="title">404 NOT FOUND</span>
        </div>
        <div class="text item">
            请求的页面不存在！
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
        text-align: center;
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