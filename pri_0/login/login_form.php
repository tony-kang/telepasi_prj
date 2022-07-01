<?php
    $loginLogo = $_prj['logo'][0];
    $loginLogo_h = 48;
    $loginLogo_w = $loginLogo_h * ($loginLogo['width']/$loginLogo['height']);
?>
<div class="page-wrapper auth">
    <div class="page-inner bg-brand-gradient">
        <div class="page-content-wrapper bg-transparent m-0" style="padding-left:0px;">
            <div class="height-10 w-100 shadow-lg px-4 bg-brand-gradient">
                <div class="d-flex align-items-center container p-0">
                    <div class="page-logo width-mobile-auto m-0 align-items-center justify-content-center p-0 bg-transparent bg-img-none shadow-0 height-9 border-0">
                        <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
                            <img src="<?= $loginLogo['url'] ?>" aria-roledescription="logo" style="width:<?= $loginLogo_w ?>px; height:<?= $loginLogo_h ?>px;">
                            <?php /*
                                <span class="page-logo-text mr-1"><?= MY_PRJ_TITLE ?></span>
                            */ ?>
                        </a>
                    </div>
                    <a class="btn-link text-white ml-auto"><?= MY_PRJ_TITLE ?></a>
                    <?php /*
                        <a href="/?cfg=join" class="btn-link text-white ml-auto">
                            Create Account
                        </a>
                    */ ?>
                </div>
            </div>
            <div class="flex-1" style="background: url(<?= ASSETS_URL ?>/img/svg/pattern-1.svg) no-repeat center bottom fixed; background-size: cover;">
                <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
                    <div class="row">
                        <div class="col col-md-6 col-lg-7 hidden-sm-down">
                            <h2 class="fs-xxl fw-500 mt-4 text-white">
                                <my style="color:red;">Ondongne</my> Rent Manager
                                <small class="h3 fw-300 mt-3 mb-5 text-white opacity-60">
                                    온동네 임대관리
                                </small>
                            </h2>
                            <a href="#" class="fs-lg fw-500 text-white opacity-70" data-obj-action="view_idList">Learn more &gt;&gt;</a>
                            <?php if (!___isMobile() && $idListForDebug) :?>
                                <div id="id_forDebug" style="display:none; height:150px; overflow:scroll;"><?= $idListForDebug ?></div>
                            <?php endif ?>
                            <div class="d-sm-flex flex-column align-items-center justify-content-center d-md-block">
                                <div class="px-0 py-1 mt-5 text-white fs-nano opacity-50">
                                    Find us on social media
                                </div>
                                <div class="d-flex flex-row opacity-70">
                                    <a href="#" class="mr-2 fs-xxl text-white">
                                        <i class="fab fa-facebook-square"></i>
                                    </a>
                                    <a href="#" class="mr-2 fs-xxl text-white">
                                        <i class="fab fa-twitter-square"></i>
                                    </a>
                                    <a href="#" class="mr-2 fs-xxl text-white">
                                        <i class="fab fa-google-plus-square"></i>
                                    </a>
                                    <a href="#" class="mr-2 fs-xxl text-white">
                                        <i class="fab fa-linkedin"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-5 col-xl-4 ml-auto">
                            <h1 class="text-white fw-500 mb-3 d-sm-block d-md-none" data-obj-action="view_idList">
                                로그인
                            </h1>
                            <?php if (___isMobile() && $idListForDebug) :?>
                                <div id="id_forDebug" style="display:none; height:150px; overflow:scroll;"><?= $idListForDebug ?></div>
                            <?php endif ?>
                            <div class="card p-4 rounded-plus bg-faded">
                                <form id="js-login" novalidate="" action=""
                                      <?php
                                        /* data-action 이름을 바꿈. app.bundle.js에서 data-action을 사용중 -- 모바일에서 클릭 문제 발생
                                        main.php , src/action/action_main.php 등의 소스 수정해야 함. */
                                      ?>
                                      data-actionID="login"
                                      data-referer="<?php echo ___getReferenceUrl(); ?>"
                                      data-start="/"
                                      data-ssID="<?php echo session_id(); ?>"
                                      >
                                    <div class="form-group">
                                        <label class="form-label" for="username">Username</label>
                                        <input type="text" id="username" class="form-control form-control-lg" placeholder="your ID or Email" required>
                                        <div class="invalid-feedback">No, you missed this one.</div>
                                        <div class="help-block">Your unique username to app</div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" id="password" class="form-control form-control-lg" placeholder="password" required>
                                        <div class="invalid-feedback">Sorry, you missed this one.</div>
                                        <div class="help-block">Your password</div>
                                    </div>
                                    <?php /*
                                    <div class="form-group text-left">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="rememberme">
                                            <label class="custom-control-label" for="rememberme"> Remember me for the next 30 days</label>
                                        </div>
                                    </div> */ ?>
                                    <div class="row no-gutters">
                                        <div class="col-lg-6 pr-lg-1 my-2">
                                            <!--button type="submit" class="btn btn-info btn-block btn-lg">Sign in with <i class="fab fa-google"></i></button-->
                                        </div>
                                        <div class="col-lg-6 pl-lg-1 my-2">
                                            <button id="js-login-btn" type="submit" class="btn btn-danger btn-block btn-lg">Login</button>
                                        </div>
                                    </div>
                                    <div class="row help-block my-cursor-pointer"><?= $_SERVER['REMOTE_ADDR'] ?></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?= ___poweredByDesc() ?>
                </div>
            </div>
        </div>
    </div>
</div>
