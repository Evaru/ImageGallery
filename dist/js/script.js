"use strict";function classToggleMenu(){this.classList.toggle("menu_state_open"),this.closest(".header__menu").classList.toggle("active__menu")}document.querySelector(".menu__burger__span").addEventListener("click",classToggleMenu),$(document).ready(function(){$.ajax({type:"GET",url:"back/img.php",success:function(c){$(".content__look").html(c)}}),$.ajax({type:"GET",url:"back/info.php",success:function(c){$(".filter__edit").html(c)}}),$(".menu__burger__span-add").click(function(){$.ajax({type:"GET",url:"back/add.php",success:function(c){$(".filter__edit").html(c)}})}),$(".menu__burger__span-info").click(function(){$.ajax({type:"GET",url:"back/info.php",success:function(c){$(".filter__edit").html(c)}})}),$(".menu__burger__span-filter").click(function(){$.ajax({type:"GET",url:"back/filter.php",success:function(c){$(".filter__edit").html(c)}})}),$(".menu__burger__span-search").click(function(){$.ajax({type:"GET",url:"back/search.php",success:function(c){$(".filter__edit").html(c)}})}),$(document).on("click","#abc",function(){$.ajax({type:"GET",url:"back/abc.php",success:function(c){$(".content__look").html(c)}})}),$(document).on("click","#date",function(){$.ajax({type:"GET",url:"back/date.php",success:function(c){$(".content__look").html(c)}})})}),$(document).on("click",".menu__burger__span",function(){$(".filter").toggleClass("filter-block")});