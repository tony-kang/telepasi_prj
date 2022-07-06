# UI & UX

## 폴더구성 및 폴더 Configuration
1. 기능이 비슷하거나 관리를 위해 묶어야 하는 폴더를 기준으로 소스가 관리됩니다. 
   1. 데모를 위한 폴더를 구성한다고 할 때 데모의 종류는 계속 생길 것이고 생기는 데모는 메뉴에 존재할 것입니다. 
      1. 매뉴를 클릭하여 demo1 , demo2 등이 실행된다고 할 때 
         <div>폴더의 구성은
            <div style="margin-left:20px; color:#8ff">menuDemo</div>
            <div style="margin-left:40px; color:#88f">- demo1</div>
            <div style="margin-left:40px; color:#88f">- demo2</div>
            <div style="margin-left:40px; color:#a88">- menuDemo.main.php</div>
         </div>

### menuDemo라는 폴더를 만들었다고 하면
####### myPrj/pri_0/nav/siteNav.php 에 아래 코드를 추가하면 Left Menu가 생성됩니다.
```
$_nav['menuDemo'] = [
    'title' => '데모',
    'icon' => 'fal fa-file-powerpoint',
    'items' => [
        'demo1'      => [ 'title' => '데모 (1)', 'url' => '/?cfg=menuDemo&mN=demo1' ],
        'demo2'      => [ 'title' => '데모 (2)', 'url' => '/?cfg=menuDemo&mN=demo2' ],
    ]
];
```
#### menuDemo 의 텍스트 위치와 demo1 , demo2의 텍스트 위치를 기억해 주세요.
#### 기능의 이름이 `menu`로 시작하는 경우
<span style="color:#a88">pri_0 / menu / <span style="color:#eaa">menuDemo</span> / <span style="color:#eaa">menuDemo</span>.main.php</span> 이 자동호출 됩니다.
```
호출되는 파일의 이름은 url에 Top Menu 파라미터인 mT , mTs 를 추가하여 파일을 변경할 수 있습니다.

mT    : Top Menu의 Main 메뉴
mTs   : Top Menu의 sub 메뉴 
```

