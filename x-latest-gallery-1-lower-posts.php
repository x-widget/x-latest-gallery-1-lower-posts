<?
widget_css();
if( $widget_config['forum1'] ) $_bo_table = $widget_config['forum1'];
else $_bo_table = $widget_config['default_forum_id'];

if( $widget_config['no'] ) $limit = $widget_config['no'];
else $limit = 2;

$list = g::posts( array(
			"bo_table" 	=>	$_bo_table,
			"limit"		=>	$limit,
			"select"	=>	"idx,domain,bo_table,wr_id,wr_parent,wr_is_comment,wr_comment,ca_name,wr_datetime,wr_hit,wr_good,wr_nogood,wr_name,mb_id,wr_subject,wr_content"
				)
		);	
		
if ($list) { ?>
<div class='latest-gallery-1-lower-posts'>
	<?	
		$i = 1;
		foreach ($list as $post) {
			$thumb = get_list_thumbnail($_bo_table, $post['wr_id'], 233, 208);    					            
			if( empty($thumb['src']) ) {
				$_wr_content = db::result("SELECT wr_content FROM $g5[write_prefix]$_bo_table WHERE wr_id='$post[wr_id]'");
				$image_from_tag = g::thumbnail_from_image_tag( $_wr_content, $_bo_table, 233-2, 208-1 );
				if ( empty($image_from_tag) ) $img = "<img class='img_left' src='".x::url()."/widget/$widget_config[name]/img/no-image.png'/>";
				else $img = "<img class='img_left' src='$image_from_tag'/>";
				$count_image ++;
			} else {
				$img = '<img class="img_left" src="'.$thumb['src'].'">';
				$count_image ++;				
			}
	?>
		<div class="post-item <? if ($i%2==1) echo 'left-item'?>">
			<div class='post-image'>
				<a href="<?=$post['url']?>"><?=$img?></a>
			</div>
			<div class='post-content-container'>
				<div class='post-subject'><a href="<?=$post['url']?>"><?=cut_str($post['wr_subject'],20,'...')?></a></div>
				<div class='post-content'><a href="<?=$post['url']?>"><?=cut_str(strip_tags($post['wr_content']),175,'...')?></a></div>
			</div>
			<div style='clear: left'></div>		
		</div>
	<?$i++;}?>
		<div style='clear: left'></div>
</div>
<? } else { ?>
<div class='latest-gallery-1-lower-posts'>
	<?
		$no_subject = "회원님게서는 현재...";
		$no_content = "필고 갤러리 테마 No.1을 선택 하였습니다. <br />
						메인 배너의 이미지는 <a style='font-weight: bold; color:#355c75;' href='".url_site_config()."'>사이트 관리</a>의 일반 설정에서 배너 이미지를 등록 해 주세요.";
		for ( $i=1; $i<=2; $i++ ) { 
			$img = "<img src='$latest_skin_url/img/no_bottom_$i.png'/>";
	?>
		<div class="post-item <? if ($i%2==1) echo 'left-item'?>">
			<div class='post-image'>
				<a href="javascript:void(0)"><?=$img?></a>
			</div>
			<div class='post-content-container'>
				<div class='post-subject'><a href="javascript:void(0)"><?=$no_subject?></a></div>
				<div class='post-content'><a href="javascript:void(0)"><?=$no_content?></a></div>
			</div>
			<div style='clear: left'></div>		
		</div>		
		
		
	<?}?>
	
	<? } ?>
		<div style='clear: left'></div>
</div>