
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>后台管理系统-登录</title>
    <link rel="stylesheet" type="text/css" href="/static/login/layui/css/layui.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/static/login/css/login.css" />
</head>
<body class="beg-login-bg">
    <div class="beg-login-box">
        <header>
            <h1>登录</h1>
        </header>
        <div class="beg-login-main">
            <form action="/logindo" class="layui-form" method="post">
              <div class="layui-form-item">
                  <label class="beg-login-icon">
                      <i class="layui-icon"></i>
                  </label>
                  @if (session('msg'))
                  <div class="alert alert-success">
                      <h5 style="color:black">{{ session('msg') }}</h5>
                  </div>
                  @endif
              </div>
                <div class="layui-form-item">
                    <label class="beg-login-icon">
                        <i class="layui-icon">&#xe612;</i>
                    </label>
                    <input type="text" lay-verify="required" name="admin_user" autocomplete="off" placeholder="这里输入管理员名称" class="layui-input" lay-verType="tips">
                </div>
                <div class="layui-form-item">
                    <label class="beg-login-icon">
                        <i class="layui-icon">&#xe642;</i>
                    </label>
                    <input type="password" lay-verify="required" name="admin_pwd" autocomplete="off" placeholder="这里输入密码" class="layui-input" lay-verType="tips">
                </div>
                <div class="layui-form-item">
                    <div class="beg-pull">
                        <button type="submit" class="layui-btn layui-btn-normal" style="width:100%;">
                            登　　录
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <footer>
            <p>power by dw © </p>
        </footer>
    </div>
    <script type="text/javascript" src="/static/login/javascript/jquery.min.js"></script>
    <script type="text/javascript" src="/static/login/layui/layui.js"></script>
    <script type="text/javascript" src="/static/login/javascript/login.js"></script>
</body>
</html>
