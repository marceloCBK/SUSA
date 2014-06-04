<?php
	/*	Funчуo dia da Semana
		Autor: Joуo Teixeira Junior */
	
	function numDiaSemana($num) {
		if($num == 1){
			return $dia = 'Domingo';
		}
		if($num == 2){
			return $dia = 'Segunda';
		}
		if($num == 3){
			return $dia = 'Ter&ccedil;a';
		}
		if($num == 4){
			return $dia = 'Quarta';
		}
		if($num == 5){
			return $dia = 'Quinta';
		}
		if($num == 6){
			return $dia = 'Sexta';
		}
		if($num == 7){
			return $dia = 'S&acute;bado';
		}
	}

	function textDiaSemana($text) {
		if($text == 'DOMINGO'){
			return $dia = 1;
		}
		if($text == 'SEGUNDA-FEIRA'){
			return $dia = 2;
		}
		if($text == 'TERЧA-FEIRA'){
			return $dia = 3;
		}
		if($text == 'QUARTA-FEIRA'){
			return $dia = 4;
		}
		if($text == 'QUINTA-FEIRA'){
			return $dia = 5;
		}
		if($text == 'SEXTA-FEIRA'){
			return $dia = 6;
		}
		if($text == 'SСBADO'){
			return $dia = 7;
		}
	}
		
	function traducaoDia($text) {
		if($text == 'Sunday') {
			return $dia = 'Domingo';
		}
		if($text == 'Monday') {
			return $dia = 'Segunda';
		}
		if($text == 'Tuesday') {
			return $dia = 'Ter&ccedil;a';
		}
		if($text == 'Wednesday') {
			return $dia = 'Quarta';
		}
		if($text == 'Thursday') {
			return $dia = 'Quinta';
		}
		if($text == 'Friday') {
			return $dia = 'Sexta';
		}
		if($text == 'Saturday') {
			return $dia = 'S&acute;bado';
		}
	}
	
	function traducaoMes($text) {
		if($text == 'January') {
			return $mes = 'Janeiro';
		}
		if($text == 'February') {
			return $mes = 'Fevereiro' ;
		}
		if($text == 'March') {
			return $mes = 'Mar&ccedil;o';
		} 
		if($text == 'April') {
			return $mes = 'Abril';
		}
		if($text == 'May') {
			return $mes = 'Maio';
		}
		if($text == 'June') {
			return $mes = 'Junho';
		}
		if($text == 'July') {
			return $mes = 'Julho';
		}
		if($text == 'August') {
			return $mes = 'Agosto';
		}
		if($text == 'September') {
			return $mes = 'Setembro';
		}
		if($text == 'October') {
			return $mes = 'Outubro';
		}
		if($text == 'November') {
			return $mes = 'Novembro';
		}
		if($text == 'December') {
			return $mes = 'Dezembro';
		}
	}
	
	function numMes($num) {
		if($num == 1) {
			return $mes = 'Janeiro';
		}
		if($num == 2) {
			return $mes = 'Fevereiro' ;
		}
		if($num == 3) {
			return $mes = 'Mar&ccedil;o';
		} 
		if($num == 4) {
			return $mes = 'Abril';
		}
		if($num == 5) {
			return $mes = 'Maio';
		}
		if($num == 6) {
			return $mes = 'Junho';
		}
		if($num == 7) {
			return $mes = 'Julho';
		}
		if($num == 8) {
			return $mes = 'Agosto';
		}
		if($num == 9) {
			return $mes = 'Setembro';
		}
		if($num == 10) {
			return $mes = 'Outubro';
		}
		if($num == 11) {
			return $mes = 'Novembro';
		}
		if($num == 12) {
			return $mes = 'Dezembro';
		}
	}
?>