## 基本规则
1. baseUrl: http://bihu.jay86.com/
2. 所有接口POST，参数 x-www-form-urlencoded模式，返回:json。
3. 状态码：
   - 200 —— 成功
   - 400 —— 参数错误
   - 401 —— 用户认证错误
   - 500 —— 奇怪的错误

4. 登录后用token代表用户。
5. 上传图片时请上传图片地址。本API不负责图片文件储存，图片储存请右转阿里，七牛，然后把图片地址传上来。

## 接口详情
### 1. 注册
url: register.php

请求体：<br>

| 参数         | 参数说明 |
| ----------- | -------- |
| username    | 用户名   |
| password    | 密码     |

返回：

```json
{
    "status": 200,
    "info": "success",
    "data": {
        "id": 2,
        "username": "Jay",
        "password": "123456",
        "avatar": null,
        "token": "ac2f704deb121877d0895cf5bb96716981610c5f"
    }
}
```

### 2. 登陆
url: login.php

请求体：<br>

| 参数         | 参数类型   |
| ----------- | ---------- |
| username    | 用户名     |
| password    | 密码       |

返回：

```json
{
    "status": 200,
    "info": "success",
    "data": {
        "id": 2,
        "username": "Jay",
        "avatar": null,
        "token": "97439adacfee0e479abb96d55df450fc5eb5a372"
    }
}
```

### 3. 修改头像
url: modifyAvatar.php

请求体：<br>

| 参数         | 参数类型   |
| ----------- | ---------- |
| token       | 登陆时返回的token |
| avatar      | 头像地址    |

返回：

```json
{
    "status": 200,
    "info": "success"
}
```

### 4. 修改密码
url: changePassword.php

请求体：<br>

| 参数         | 参数类型   |
| ----------- | ---------- |
| password    | 新密码     |
| token       | 登陆时返回的token    |

返回：

```json
{
    "status": 200,
    "info": "success",
    "data": {
        "token": "8ab2f3485e124386db45ff6b92eb3ea0a288e953"
    }
}
```

### 5. 发布问题
url: question.php

请求体：<br>

| 参数         | 参数类型   |
| ----------- | ---------- |
| title       | 标题       |
| content     | 正文       |
| images      | 可空，图片地址（多张图片用英文逗号分隔） |
| token       | 登陆时返回的token                     |

返回：

```json
{
    "status": 200,
    "info": "success"
}
```

### 6. 取问题列表
url: getQuestionList.php

请求体：<br>

| 参数         | 参数类型   |
| ----------- | ---------- |
| page        | 页数       |
| count       | 可空，每页条数，默认20条 |
| token       | 登陆时返回的token       |

返回：

```json
{
    "status": 200,
    "info": "success",
    "data": {
        "totalCount": 2,
        "totalPage": 1,
        "questions": [
            {
                "id": 2,
                "title": "孤独的等待",
                "content": "怎么还没有人来玩啊",
                "images": "http://ok4qp4ux0.bkt.clouddn.com/1485064307258",
                "date": "2017-12-26 16:53:04",
                "exciting": 0,
                "naive": 0,
                "recent": null,
                "answerCount": 0,
                "authorId": 2,
                "authorName": "Jay",
                "authorAvatar": "http://ok4qp4ux0.bkt.clouddn.com/img-222c4cafc0af1718a6a3b45224cf5229.jpg",
                "is_exciting": false,
                "is_naive": false,
                "is_favorite": false
            },
            {
                "id": 1,
                "title": "欢迎来到逼乎",
                "content": "让我们在撕逼中寻找答案",
                "images": "http://ok4qp4ux0.bkt.clouddn.com/logo.png,http://ok4qp4ux0.bkt.clouddn.com/1485064307258",
                "date": "2017-12-26 16:41:52",
                "exciting": 0,
                "naive": 0,
                "recent": null,
                "answerCount": 0,
                "authorId": 2,
                "authorName": "Jay",
                "authorAvatar": "http://ok4qp4ux0.bkt.clouddn.com/img-222c4cafc0af1718a6a3b45224cf5229.jpg",
                "is_exciting": false,
                "is_naive": false,
                "is_favorite": false
            }
        ],
        "curPage": 0
    }
}
```
> 注：recent表示最近回复时间，没有回复时为null。

### 7. 发布回答
url: answer.php

请求体：<br>

| 参数         | 参数类型   |
| ----------- | ---------- |
| qid         | 问题id     |
| content     | 正文       |
| images      | 可空，图片地址（多张图片用英文逗号分隔） |
| token       | 登陆时返回的token                     |

返回：

```json
{
    "status": 200,
    "info": "success"
}
```

### 8. 取回答列表
url: getAnswerList.php

请求体：<br>

| 参数         | 参数类型   |
| ----------- | ---------- |
| page        | 页数       |
| count       | 可空，每页条数，默认20条 |
| qid         | 问题id     |
| token       | 登陆时返回的token       |

返回：

```json
{
    "status": 200,
    "info": "success",
    "data": {
        "totalCount": 2,
        "totalPage": 1,
        "answers": [
            {
                "id": 1,
                "content": "自娱自乐",
                "images": "http://ok4qp4ux0.bkt.clouddn.com/img-222c4cafc0af1718a6a3b45224cf5229.jpg",
                "date": "2017-12-26 16:56:33",
                "best": 0,
                "exciting": 0,
                "naive": 0,
                "authorId": 2,
                "authorName": "Jay",
                "authorAvatar": "http://ok4qp4ux0.bkt.clouddn.com/img-222c4cafc0af1718a6a3b45224cf5229.jpg",
                "is_exciting": false,
                "is_naive": false
            },
            {
                "id": 2,
                "content": "自娱自乐+1",
                "images": "http://ok4qp4ux0.bkt.clouddn.com/img-222c4cafc0af1718a6a3b45224cf5229.jpg",
                "date": "2017-12-26 16:57:10",
                "best": 0,
                "exciting": 0,
                "naive": 0,
                "authorId": 2,
                "authorName": "Jay",
                "authorAvatar": "http://ok4qp4ux0.bkt.clouddn.com/img-222c4cafc0af1718a6a3b45224cf5229.jpg",
                "is_exciting": false,
                "is_naive": false
            }
        ],
        "curPage": 0
    }
}
```

### 9. 收藏
url: favorite.php

请求体：<br>

| 参数         | 参数类型   |
| ----------- | ---------- |
| qid         | 问题id     |
| token       | 登陆时返回的token |

返回：

```json
{
    "status": 200,
    "info": "success"
}
```

### 10. 取消收藏
url: cancelFavorite.php

请求体：<br>

| 参数         | 参数类型   |
| ----------- | ---------- |
| qid         | 问题id     |
| token       | 登陆时返回的token |

返回：

```json
{
    "status": 200,
    "info": "success"
}
```

### 11. 取收藏列表
url: getFavoriteList.php

请求体：<br>

| 参数         | 参数类型   |
| ----------- | ---------- |
| page        | 页数       |
| count       | 可空，每页条数，默认20条 |
| token       | 登陆时返回的token       |

返回：

```json
{
    "status": 200,
    "info": "success",
    "data": {
        "totalCount": 2,
        "totalPage": 1,
        "questions": [
            {
                "id": 1,
                "title": "欢迎来到逼乎",
                "content": "让我们在撕逼中寻找答案",
                "images": "http://ok4qp4ux0.bkt.clouddn.com/logo.png,http://ok4qp4ux0.bkt.clouddn.com/1485064307258",
                "date": "2017-12-26 16:41:52",
                "exciting": 0,
                "naive": 0,
                "recent": "2017-12-26 16:57:10",
                "answerCount": 2,
                "authorId": 2,
                "authorName": "Jay",
                "authorAvatar": "http://ok4qp4ux0.bkt.clouddn.com/img-222c4cafc0af1718a6a3b45224cf5229.jpg",
                "is_exciting": false,
                "is_naive": false
            }
        ],
        "curPage": 0
    }
}
```

### 12. 采纳
url: accept.php

请求体：<br>

| 参数         | 参数类型   |
| ----------- | ---------- |
| qid         | 问题id     |
| aid         | 回答id     |
| token       | 登陆时返回的token |

返回：

```json
{
    "status": 200,
    "info": "success"
}
```

### 13. ![](http://www.webpagefx.com/tools/emoji-cheat-sheet/graphics/emojis/+1.png)
url: exciting.php

请求体：<br>

| 参数         | 参数类型   |
| ----------- | ---------- |
| id          | id         |
| type        | 回答 -> 2, 问题 -> 1 |
| token       | 登陆时返回的token    |

返回：

```json
{
    "status": 200,
    "info": "excited"
}
```

### 14. 取消![](http://www.webpagefx.com/tools/emoji-cheat-sheet/graphics/emojis/+1.png)
url: cancelExciting.php

请求体：<br>

| 参数         | 参数类型   |
| ----------- | ---------- |
| id          | id         |
| type        | 回答 -> 2, 问题 -> 1 |
| token       | 登陆时返回的token    |

返回：

```json
{
    "status": 200,
    "info": "success",
}
```

### 15. ![](http://www.webpagefx.com/tools/emoji-cheat-sheet/graphics/emojis/-1.png)
url: naive.php

请求体：<br>

| 参数         | 参数类型   |
| ----------- | ---------- |
| id          | id         |
| type        | 回答 -> 2, 问题 -> 1 |
| token       | 登陆时返回的token    |

返回：

```json
{
    "status": 200,
    "info": "naive"
}
```

### 16.取消![](http://www.webpagefx.com/tools/emoji-cheat-sheet/graphics/emojis/-1.png)
url: cancelNaive.php

请求体：<br>

| 参数         | 参数类型   |
| ----------- | ---------- |
| id          | id         |
| type        | 回答 -> 2, 问题 -> 1 |
| token       | 登陆时返回的token    |

返回：

```json
{
    "status": 200,
    "info": "success"
}
```