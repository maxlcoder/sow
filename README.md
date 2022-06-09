## 示例框架结构

### 结构目录

```php
app
├── Console  `任务&定时任务`
│   └── Kernel.php
├── Enum  `常量类`
│   └── ArticleEnum.php
├── Exceptions
│   └── Handler.php
├── Http
│   ├── Controllers    `控制器 （负责分发API 到 业务执行单元 Runner）`
│   │   ├── Admin  `后台控制器`
│   │   │   ├── AdminBaseController.php
│   │   │   ├── AdminController.php
│   │   │   └── ExampleController.php
│   │   ├── Api  `前台控制器`
│   │   │   └── ApiBaseController.php
│   │   └── Controller.php
│   ├── Kernel.php
│   ├── Middleware   `中间件（鉴权，权限，过滤）`
│   │   ├── Authenticate.php
│   │   ├── EncryptCookies.php
│   │   ├── PreventRequestsDuringMaintenance.php
│   │   ├── RedirectIfAuthenticated.php
│   │   ├── TrimStrings.php
│   │   ├── TrustHosts.php
│   │   ├── TrustProxies.php
│   │   └── VerifyCsrfToken.php
│   ├── Requests  `前置第一层入参校验 （入参校验，在 Controller 中进行第一层参数校验）`
│   │   └── Admin
│   │       └── Example
│   │           └── StoreRequest.php
│   └── Runner  `业务逻辑执行单元 （API 的具体的执行服务类，通过调用 Repository 和 Service 完成复杂的业务逻辑）`
│       ├── Admin
│       │   ├── Admin
│       │   │   ├── LoginRunner.php
│       │   │   └── MeRunner.php
│       │   └── Example
│       │       ├── IndexRunner.php  `最小业务执行单元`
│       │       └── StoreRunner.php
│       └── Runner.php
├── Jobs  `异步任务`
│   └── DoSomething.php
├── Models  `数据表模型`
│   ├── ArticleModel.php
│   └── User.php
├── Providers
│   ├── AppServiceProvider.php
│   ├── AuthServiceProvider.php
│   ├── BroadcastServiceProvider.php
│   ├── EventServiceProvider.php
│   └── RouteServiceProvider.php
├── Repository  `业务数据对象操作持久层  Repository -> Model （具体业务对象及其操作）`
│   ├── BaseRepository.php  `基础 Repository`
│   ├── Contract  `契约，接口约束`
│   │   └── ExampleContract.php
│   └── ExampleRepository.php  `示例 Repository`
└── Service  `公共服务层/对象层 （比 Repository 更高层次的业务封装，同时作为公共服务的载体，比如Upload等第三方的服务操作类）`
    └── BaseService.php
    └── UploadService.php

```

### 基础功能

#### 1. 一套代码支持多端，通过 routes 目录文件区分
> api：表示前台  
> admin: 表示后台  
> openapi: 表示开放平台

#### 2. 集成 tymon/jwt-auth 扩展包，示例代码配置已支持前台和后台的用户登录，支持多套用户登录鉴权体系
> auth('api') 表示前台，获取用户信息通过 auth('api')->user()  
> auth('admin') 表示后台，获取用户信息通过 auth('admin')->user()


#### 3. 完整的 migration ，支撑项目初始化，为自动化测试提供数据支撑

#### 4. 集成 overtrue/laravel-query-logger 扩展包，SQL 调试必备，可根据环境自定义开启关闭
```shell
[2022-06-08 14:10:00] local.DEBUG: [example] [12.5ms] select * from `admin` where `id` = '1' limit 1 | GET: /admin/me
[2022-06-08 14:10:21] local.DEBUG: [example] [13.45ms] select * from `admin` where `id` = '1' limit 1 | GET: /admin/me
```

### TODO 
* 权限系统集成
* 开放平台加密体系
* 文件上传模块集成

