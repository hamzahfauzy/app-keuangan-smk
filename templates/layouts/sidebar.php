<!-- Sidebar -->
<div class="sidebar sidebar-style-2">			
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="text-center">
                    <img src="<?=config('theme')['logo']?>" width="150px" height="100px" alt="logo" style="object-fit:contain;">
                </div>
                <div class="info text-center mt-2">
                    <a href="">
                        <span>
                            <?=app('name')?>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
            <ul class="nav <?=config('theme')['sidebar_color']?>">
                <?= generated_menu(auth()->user->id) ?>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->