<?php
/**
 * [WeEngine System] Copyright (c) 2014 WE7.CC
 * WeEngine is NOT a free software, it under the license terms, visited http://www.we7.cc/ for more details.
 */
defined('IN_IA') or exit('Access Denied');

load()->func('file');
load()->model('module');
load()->model('user');
load()->model('account');
load()->classs('weixin.platform');

$uniacid = intval($_GPC['uniacid']);
$step = intval($_GPC['step']) ? intval($_GPC['step']) : 1;
$user_create_account_info = permission_user_account_num();
$dos = array('check_account_limit');
$do = in_array($do, $dos) ? $do : '';
$_W['breadcrumb'] = '新建平台账号';
if ('check_account_limit' == $do) {
	if ($user_create_account_info['account_limit'] <= 0 && !$_W['isfounder']) {
		iajax(-1, '创建公众号已达上限！');
	}

	if (!empty($_W['setting']['platform']['authstate'])) {
		$account_platform = new WeixinPlatform();
		$authurl = $account_platform->getAuthLoginUrl();
		iajax(0, array('url' => $authurl));
	}
	iajax(-1, '请求错误');
}

if (1 == $step) {

} elseif (2 == $step) {
	} elseif (3 == $step) {
	} elseif (4 == $step) {
	$uniacid = intval($_GPC['uniacid']);
	$uni_account = pdo_get('uni_account', array('uniacid' => $uniacid));
	if (empty($uni_account)) {
		itoast('非法访问');
	}
	$owner_info = account_owner($uniacid);
	if (!(user_is_founder($_W['uid'], true) || $_W['uid'] == $owner_info['uid'])) {
		itoast('非法访问');
	}
	$account = account_fetch($uni_account['default_acid']);
}
template('account/post-step');