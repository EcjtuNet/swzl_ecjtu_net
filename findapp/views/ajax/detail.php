<?php if($ajax){
	echo json_encode(array('phone'=>$phone));
}else{ ?>

<td class=".detail-title" style="color: #696969; font-size: 14px; line-height: 14px; text-align: right; width: 110px;">联系电话：</td>
<td><?php echo $this->data['phone']; ?></td><?php } ?>
