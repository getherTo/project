<?php
/*
 * �ļ������� 2008-10-2 �� PHPeclipse - PHP - Code Templates
 */



/**
 * ����Ƿ���Ч��URL��ַ�������߼�ֵ��
 */
function checkurl ($urladdr) {
	$urladdr=trim($urladdr);
	if(strlen($urladdr)<4 or strlen($urladdr)>100)return false;
	if(!strstr($urladdr,'.'))return false;   //���������.����Ϊ�Ƿ�URL��
	$badchar=explode(" ","+ ' �� ( ) < > [ ] { } \\ ; \" ".chr(0)." -- .. @@ @.");//���岻���е��ַ���
	$count=count($badchar);
	for($i=0;$i<$count;$i++){
		if(strstr($urladdr,$badchar[$i]))return false;  //����ҵ������ַ�������Ϊ�Ƿ�URL��
	}
	if(strstr($urladdr,' '))return false;  //����ҵ���ǿո񣬶���Ϊ�Ƿ�URL��
	$urlchar=str_split($urladdr);  //��URL���ÿһ���ֽڡ�
	$count=count($urlchar);
	if($urlchar[0]=='@' or $urlchar[0]=='.' or $urlchar[$count-1]=='@' or $urlchar[$count-1]=='.')return false;  //���URL��ʼ������ҵ� "@ ." ����Ϊ�Ƿ�URL��
	$echar=explode('@',$urladdr);
	if(count($echar)>2)return false;
	if(count($echar)==2){
		if(!strstr($echar[1],'.'))return false;
	}
	return true;
}
/**
 * ����Ƿ���Ч��E-Mail��ַ�������߼�ֵ
 * Ҫ�õ�checkurl������
 */
function checkemail ($emailaddr) {
	if(!checkurl($emailaddr))return false;
	if(!strstr($emailaddr,'@'))return false;
	return true;

}
/**
 * ����Ƿ��ⲿ���ӡ�������ⲿ���ӷ��� �档
 * ������·�����ļ�����ǰ����б�ܣ��ж��Ƿ�������·�������Ӷ�����
 */
function isoutlink($path=''){
	$hostname=$_SERVER[SERVER_NAME];  //��ȡ����������
	if($path!='')$hostname=$hostname.'/'.$path;  //������������ָ��·��
	$lastpage=$_SERVER[HTTP_REFERER];   //��ȡ��Դҳ��(��һ����ʵ)
	$lasthost=substr($lastpage,7,strlen($hostname));  //����Դҳ��ȥ��HTTP��//��ȡ��ͬ���ȡ�
	if(strcmp($hostname,$lasthost)==0)return false; //�ڲ�����
	return true; //��ָ���������
}

/**
 * ����û�����ʽ�Ƿ���ȷ��4-16�����ģ���ĸ�����֣��»��ߣ�����
 */
function checkusername ($name,$min=4,$max=16) {
	if(strlen($name)<$min or strlen($name)>$max)return false;
	$preg="/^[\w\\x80-\\xff-]+$/";  //�����ַ���Χ��
//	echo "<textarea cols=80>$preg</textarea>";   //�����ǵ����õġ�
	if(!preg_match($preg,$name))return false;
	if(strstr($name,'��'))return false;   //��������ȫ�ǿո�
	return true;
}


/**
 * ��������ʽ�Ƿ���ȷ��
 */
function checkpassword($password,$min=6,$max=32){
	if(strlen($password)<$min or strlen($password)>$max)return false;
	$preg="/\A[\!#-&\(-\~]+\Z/";   //�����ַ���Χ(ASCII 33-126�г�����������)��
//	echo "<textarea cols=80>$preg</textarea>";   //�����ǵ����õ�
	if(preg_match($preg,$password))return true;
	return false;
}

/**
 * ����Ƿ��ǺϷ��ĵ绰���룬�̶��绰���뷵��1���ֻ����뷵��2��
 * ���ǵ绰���뷵��false��
 */
function checkphone ($phone) {
	$preggh="/\A(0[0-9]{2,3}[- ]?)?[2-9][0-9]{6,7}([- ]\d{1,6})?\Z/";  //�̶��绰��ʽ
	$pregsj="/\A0?1[53][0-9]{9}\Z/";              //�ֻ������ʽ
	if(preg_match($pregsj,$phone))return 2;
	if(preg_match($preggh,$phone))return 1;
	return false;
}

/**
 * ����Ƿ���Ч�ʱ�
 */
function checkpost ($post) {
	$preg="/\A[0-9]{6}\Z/";
	if(preg_match($preg,$post))return true;
	return false;
}

/**
 * ���IP��ַ�Ƿ���ȷ��
 */
function checkipaddres ($ipaddres) {
	$preg="/\A((([0-9]?[0-9])|(1[0-9]{2})|(2[0-4][0-9])|(25[0-5]))\.){3}(([0-9]?[0-9])|(1[0-9]{2})|(2[0-4][0-9])|(25[0-5]))\Z/";
	if(preg_match($preg,$ipaddres))return true;
	return false;
}

/**
 * ������֤����
 * ������15λ��18λ���֤���룬��ѡ���� $len ����15λ���롣
 * ����ֵ��ʧ�ܷ���FALSE���ɹ�����һ��18λ�����֤��
 */
function checksfznum ($sfznum,$len='both') {
	if(strlen($sfznum)==15&&$len=='both'){    //��$len������'both'ʱ��15λ������Ч
		$truenum=substr($sfznum,0,6).'19'.substr($sfznum,6);             //Ϊ����18λ������׼����
		$preg="/^[\d]{8}((0[1-9])|(1[0-2]))((0[1-9])|([12][\d])|(3[01]))[\d]{3}$/";
	}elseif(strlen($sfznum)==18){
		$truenum=substr($sfznum,0,17);
		$preg="/^[\d]{6}((19[\d]{2})|(200[0-8]))((0[1-9])|(1[0-2]))((0[1-9])|([12][\d])|(3[01]))[\d]{3}[0-9xX]$/";
	}else{
		return false;
	}
	if(!preg_match($preg,$sfznum))return false;   //���������ʽ���

	/*-----------���¼����18λ��֤��-------------*/
	$nsum=      substr($truenum, 0,1)*7;
	$nsum=$nsum+substr($truenum, 1,1)*9;
	$nsum=$nsum+substr($truenum, 2,1)*10;
	$nsum=$nsum+substr($truenum, 3,1)*5;
	$nsum=$nsum+substr($truenum, 4,1)*8;
	$nsum=$nsum+substr($truenum, 5,1)*4;
	$nsum=$nsum+substr($truenum, 6,1)*2;
	$nsum=$nsum+substr($truenum, 7,1)*1;
	$nsum=$nsum+substr($truenum, 8,1)*6;
	$nsum=$nsum+substr($truenum, 9,1)*3;
	$nsum=$nsum+substr($truenum,10,1)*7;
	$nsum=$nsum+substr($truenum,11,1)*9;
	$nsum=$nsum+substr($truenum,12,1)*10;
	$nsum=$nsum+substr($truenum,13,1)*5;
	$nsum=$nsum+substr($truenum,14,1)*8;
	$nsum=$nsum+substr($truenum,15,1)*4;
	$nsum=$nsum+substr($truenum,16,1)*2;
	$yzm=12-$nsum%11;
	if($yzm==10)$yzm='x';
	elseif($yzm==12)$yzm='1';
	elseif($yzm==11)$yzm='0';
	/*----------18λ��֤��������-------------*/
	if(strlen($sfznum)==18){
		if(substr($sfznum,17,1)!=$yzm)return false;
	}
	return $truenum.$yzm;
}
?>