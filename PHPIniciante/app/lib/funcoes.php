<?php

function tratarStr($str){
	return addslashes(
				htmlentities(
					utf8_decode(
						trim($str)
					)
				)
			);
}

