<?php
$joinLogo = $_prj['logo'][0];
$joinLogo_h = 48;
$joinLogo_w = $joinLogo_h * ($joinLogo['width']/$joinLogo['height']);
?>
<div class="page-wrapper auth">
    <div class="page-inner bg-brand-gradient">
        <div class="page-content-wrapper bg-transparent m-0">
            <div class="height-10 w-100 shadow-lg px-4 bg-brand-gradient">
                <div class="d-flex align-items-center container p-0">
                    <div class="page-logo width-mobile-auto m-0 align-items-center justify-content-center p-0 bg-transparent bg-img-none shadow-0 height-9 border-0">
                        <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
                            <img src="<?= $joinLogo['url'] ?>" aria-roledescription="logo" style="width:<?= $joinLogo_w ?>px; height:<?= $joinLogo_h ?>px;">
                        </a>
                    </div>
                    <span class="text-white opacity-50 ml-auto mr-2 hidden-sm-down">
                        Already a member?
                    </span>
                    <a href="/?cfg=login" class="btn-link text-white ml-auto ml-sm-0">
                        Secure Login
                    </a>
                </div>
            </div>
            <div class="flex-1" style="background: url(<?= ASSETS_URL ?>/img/svg/pattern-1.svg) no-repeat center bottom fixed; background-size: cover;">
                <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
                    <div class="row">

                        <div class="col-xl-12">
                            <h2 class="fs-xxl fw-500 mt-4 text-white text-center">
                                <?= PRJ_NAME ?>에 오신 것을 환영합니다.
                                <small class="h3 fw-300 mt-3 mb-5 text-white opacity-60 hidden-sm-down">
                                    서비스의 이용을 위하여 아래의 동의 내용을 확인해 주세요.
                                </small>
                            </h2>
                        </div>

                        <div class="col-xl-6 ml-auto mr-auto">
                            <div class="card p-4 rounded-plus bg-faded">
                                <form id="js-join" novalidate="" action=""
                                      data-actionID="join"
                                      data-referer="<?= ___getReferenceUrl() ?>"
                                      data-start="/?cfg=authWait"
                                >
                                    <div class="form-group row">
                                        <label class="col-xl-12 form-label" for="username">이름</label>
                                        <div class="col-6 pr-1">
                                            <input type="text" id="username" class="form-control" value="홍길동" maxlength="30" required>
                                            <div class="invalid-feedback">No, you missed this one.</div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" id="email" class="form-control" placeholder="Email for verification" value="bluein007@nate.com" required>
                                        <div class="invalid-feedback">No, you missed this one.</div>
                                        <div class="help-block">이메일은 패스워드 분실 및 계정복구를 위해서 필요합니다.</div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-12 form-label" for="pass_1">Password</label>
                                        <div class="col-6 pr-1">
                                            <input type="password" id="password" class="form-control" placeholder="minimm 8 characters" value="12345678" maxlength="20" required>
                                            <div class="invalid-feedback">Sorry, you missed this one.</div>
                                        </div>
                                        <div class="col-6 pr-1">
                                            <input type="password" id="passwordConfirm" class="form-control" placeholder="please input left password again." value="12345678" maxlength="20" required>
                                            <div class="invalid-feedback">Confim password</div>
                                        </div>
                                        <div class="col-xl-12 help-block pr-1">Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.</div>
                                    </div>
                                    <div class="form-group demo">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="agreeTerms" value="1" checked required>
                                            <label class="custom-control-label" for="agreeTerms"> 개인정보 보호방침</label>
                                                &nbsp;<my id="id_agreeTermsView" class="my-cursor-pointer text-primary" data-url="/?cfg=agreeTerms">보기</my>
                                            <div class="invalid-feedback">You must agree before proceeding</div>
                                        </div>
                                    </div>
                                    <div class="row no-gutters">
                                        <div class="col-md-4 ml-auto text-right">
                                            <button id="js-join-btn" type="submit" class="btn btn-block btn-danger btn-lg mt-3">가입 하기</button>
                                        </div>
                                    </div>
                                    <div class="row help-block my-cursor-pointer"><?= $_SERVER['REMOTE_ADDR'] ?></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?= ___poweredByDesc() ?>
            </div>
        </div>
    </div>
</div>
