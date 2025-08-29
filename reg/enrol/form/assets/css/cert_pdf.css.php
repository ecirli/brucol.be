@import url('https://fonts.googleapis.com/css?family=Great+Vibes');
#page {
			height: 760px;
        width: 1105px;
			page-break-after: always;
			float: none;
		position: relative;
		overflow: hidden;
		
	}
	#page:not(:first-child) {
		margin-top: 16px;
	}
	@media print {
		#page {
			page-break-after: always;
		}
	}
.bg {
		background: url('<?php echo gc('frame_img') ?>') no-repeat center center;
		background-size: 100% 100%;
		height: 100%;
		width: 100%;
		left: 0;
		top: 0;
		bottom: 0;
		right: 0;
		position: absolute;
		z-index: -2;
	}
.leftlogo {
		position: absolute;
		left: 145px;
		top: 80px;
	}
	.rightlogo {
		position: absolute;
		right: 150px;
		top: 80px;
	}
	.top {
	
    position: absolute;
		width: 100%;
		text-align: center;
		top: 	105px;
		left: 0;

}
	.top span {
		font-family: "Times New Roman", Times, serif;
		font-size: 18px;
		letter-spacing: 1px;
		color: #464646;
		float: left;
		width: 100%;
		margin-bottom: 4px;
	}
	
	.top_title {
	  position: absolute;
		width: 100%;
		text-align: center;
		top: 	70px;
		left: 0;

}
	.top_title span {
	font-family: "Times New Roman", Times, serif;
		font-size: 30px;
 font-weight: bold;
		letter-spacing: 1px;
		float: left;
		width: 100%;
	color: #1786DB;
		margin-bottom: 4px;
	}

	
	.de1 {
		position: absolute;
		width: 100%;
		text-align: center;
		top: 	210px;
		left: 0;
		font-family: 'Lora', serif;
	}
	.de1 > small {
		font-size: 15px;
		float: left;
		width: 100%;
		margin-bottom: 6px;
		color: #333;
	}
	.de1 > b {
		font-size: 60px;
		float: left;
		width: 100%;
		margin-bottom: 10px;
		margin-top: 10px;
		color: #e17521;
    font-family: 'Great Vibes', cursive;
    font-weight: normal;
    text-transform: capitalize !important;
	}
	.de1 > h2 {
		float: left;
		width: 80%;
		margin: 0px;
		margin-left: 10%;
		font-size: 55px;
		font-weight: normal;
		margin-top: 10px;
		margin-bottom: 4px;
		color: #094178;
		letter-spacing: -1px;
		font-family: 'Marck Script', cursive;
	}
	.title {
		background: url('assets/divider.png') no-repeat top center;
		background-size: 50%;
		padding-top: 60px;
		float: left;
		width: 100%;
		font-family: 'Lora', serif;
	}
	.title > small {
		font-size: 15px;
		float: left;
		width: 100%;
		margin-bottom: 6px;
		color: #333;
	}.title > b {
		font-size: 15px;
		float: left;
		width: 60%;
		margin-left: 20%;
		margin-bottom: 6px;
		color: #333;
		font-weight: normal;
		letter-spacing: 1px;
		font-size: 20px;
		font-family: 'Oswald', sans-serif;
	}
	.title > span {
		font-size: 15px;
		float: left;
		width: 60%;
		margin-left: 20%;
		margin-bottom: 6px;
		color: #333;
		font-weight: normal;
		font-size: 14px;
	}
	.dir {
		position: absolute;
		bottom: 70px;
		left: 190px;
		width: 300px;
		text-align: center;
	}
	.dir span {
		font-size: 16px;
		float: left;
		width: 100%;
		margin-bottom: 3px;
		color: #111;
		font-weight: normal;
		font-family: 'Lora', serif;
	}
	.dir .sign {
		background: url('<?php echo gc('sign_cert') ?>') no-repeat center center;
		            <!--url('assets/cert-sign.png') no-repeat center center;-->
		position: absolute;
		z-index: 10;
		left: 00px;
		background-size: 125px;
		top: -70px;
		width: 90;
		height: 90px;
	}
	
		.dir .sign2 {
			background: url('<?php echo gc('sign_cert') ?>') no-repeat center center;
		position: absolute;
		z-index: 10;
		left: 00px;
		background-size: 105px;
		top: -70px;
		width: 80%;
		height: 80px;
	}
	.ven {
		position: absolute;
		bottom: 70px;
		right: 190px;
		width: 300px;
		text-align: center;
	}
	.ven span {
		font-size: 11px;
		float: left;
		width: 100%;
		margin-bottom: 3px;
		color: #111;
		font-weight: normal;
		font-family: 'Lora', serif;
	}
	.stamp {
		position: absolute;
		bottom: 70px;
		left: 0;
		width: 100%;
		text-align: center;
	}
	.stamp img {
		display: inline-block;
	}