<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/8
 * Time: 16:30
 */

return [
    //应用ID,您的APPID。
    'app_id' => "2018040402501234",

    //商户私钥
    'merchant_private_key' => "MIIEpAIBAAKCAQEAzsMnfTWNUZOOm3SCxaUlIfjgGmw+EO9t2zCuQR5ps024nWzKhHxyg+Fh+/1IGpj9ojKcgjwC8R8TP/lsEL3CyLlGvmJm2WFpDo828nm5ndqmh5TUh7f7kvf0rf3dCNOl8xKUyI2JGq5WboXzG29R44QqRbmfkC3OTcjKOTXp8wjAFfIR2rEN7bjq3scMG3X1DqPo0rw7x2jqPJ6Jz3IdwqHzfaiHy+OLTVDOClJBnYJ2c+v3odP8/lMbpo4yZUnhB7WEiZBOkZLbIiL7JsR5tOcZeAPLEOheFOnwgJaRnjOvKAXnu29sxXOgohjobTSAObbHQdG6d2xKQBEwqUQBIQIDAQABAoIBAFDdwvQVnc/qBjyGtR7YGE3RKNUswJmfCzhPMdgGLRETtMDda9elVKR/4fLMfQbqD0kAwnWtQvlLThwXUUy66xPWYvTTR6Z9krk/Ch6LvS0f90HP08/BBYPVtrzWLTzmimEnQ0mtEZJ93RAdE5gHUd/KMT5T+zRItgd2IKF/lKCYdrco+vQ9PMH5ZU9f0CLLvh0A4CWQL1zvSgoXXxHDHhBlizLayON/KHeuvwkksgr+n9+hWvJx95J3vDOD1I+nfbFp1kYqbwNvW38wA9Fa3H6P8GIkaAqoWOPSK45nH+MxIE14ve/9vL16NuHDZMFcMJdHVvGNjvB2OKBW0abREoECgYEA/Y7ytIswle24jc7ISl0S44aueObiAd1DKUO23KAt33R5xY+M0Zjov6oa/DYw2/eU2Bsh3ucJ8me2uH+q0nN0ecuD0ZiXULGgtzebK84R3UukKNKKK9cu/xDKu6+JLXj9/LUHoDBKhIS4FJyUaTeOKqzTS8dS4NYQXijf9qNfEIsCgYEA0MDZJq/HkeVA2Z58XVzzMwB1TkyHPZ5qZfPG/Fq13POsibs7ZQmrvBGPZoYcVN9KMbM5Xynhl3zj1NE8JJ+8V1NzI+uIR+IzB6Vhv1pPE7AWr5Y/CIsO/RjJFIf/L6C5qDxpO0+93mSeQo25fEkizJEfvqpj/667Eol0e5CS3oMCgYEAlYLY8kSw3XdTP6sSx2aiYK9l6byav+asV4SqKuX4pq6Trz66Fk1H0NyJFPcPUGVoyxUUn880Ok+Vmq0NGRMjNz4d+FU1xEs5LVAIm4fjWM3lenzLJJa6C4TnRkx3YuzZN023tWlER2fK87xwdqpfliJaZXCfGhyfgiYwCcrDn4kCgYB0mAGxNeSFfEIoSfi0PMIo7kyWmu++XsiWgP3W3ONOsVrg4o5d9HTS6gvp+2W/kadi8vNMT5wMfFjT+Llay0zqiVV57oeDfrd5wclCkzIvkN5a29QA9Yo9mqZUrVC+TUrkyDkOQ4+Msy4hhf7fiAnDsBrG52xK1lDuHY/NpAYj+QKBgQCbstkJO3DCiNBgISpXPQ/7aSLG1ILHjLzpHJdAtaO5ZPVq2FUuxQBugo1fv2HvHrRolSFBk3WkAmFqV92XQB3IS2bkyJt0zIWBiB49Eu5Sy+rFm/CIq13nXnmR8yyZjYb614QE+JmI3P07BgzwoVdrNCU/qk6zwF7mbwXtTK04Gg==",

    //异步通知地址
    'notify_url' => "http://www.61drhome.cn/zfb_notify",

    //同步跳转
    'return_url' => "http://www.61drhome.cn",

    //编码格式
    'charset' => "UTF-8",

    //签名方式
    'sign_type'=>"RSA2",

    //支付宝网关
    'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

    //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
    'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAgPbwjBPbKQd1PbB0fMVViXnyWGOviqh1Zr/695kA4M3YDBFvy3ANzdt+GluAIkRT2D1obDC7nmDQ7hZaofMjMfO2cjUcECub6VauDIHgkkY4VO8+BFSm5sqiQz5EAKwhK3qSHXQqq8yEKqoAOPQPaliQF3/iYLnBMEUHEQNTUS9gBCtDUUhz3LEsFErnxYMdgQ9gHwAHXas8mAt+gJt79HL6cEpFsjoqBW43RZjUW8N7c50KSoDUKPUv09EA1GBg3LxLQTarQnTiu2kMQ/U2Ly3KLHNFAOEcz65DkvWnn3NFLJH3LH3J5sl29lQSxJJswqLbyulMBDZfv/Zqceki3QIDAQAB",
];