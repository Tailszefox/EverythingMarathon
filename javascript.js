function blink(obj,start,finish)
{
	jQuery(obj).fadeOut(300).fadeIn(300);
	if(start != finish)
	{ start = start+1;
		blink(obj,start,finish);
	} 
} 

function trim(string) 
{
	return string.replace(/^\s+/, "").replace(/\s+$/, "");
}

function loadGames(type, limit, div, title, cons, genre)
{
	$.post("display.php5", { type: type, title: title, console: cons, genre: genre, limit: limit }, function(data){
			div.fadeOut(200);
			div.queue(function(){
					div.html(data);
					div.fadeIn(500);
					div.dequeue();
			});
	});
}

function launchSearch()
{
	if($('#titleSearch').val() == $('#titleSearch').attr('title'))
		$('#titleSearch').val('');
	
	if($('#consolesOtherSearch').val() == $('#consolesOtherSearch').attr('title'))
		$('#consolesOtherSearch').val('');
	
	var title = trim($('#titleSearch').val());
	var cons = $('#consolesSearch').val();
	var consOther = trim($('#consolesOtherSearch').val());
	var genre = $('#genresSearch').val();
	
	if(cons == 'other')
		cons = consOther;
	
	loadGames('search', 100, $('#searchResult'), title, cons, genre);
}

$(document).ready(function(){
		if($('#topGamesTable').length)
		{
			loadGames('topGames', 15, $('#topGamesTable'));
			loadGames('lastVotes', 10, $('#lastVotesTable'));
			loadGames('lastGames', 10, $('#lastGamesTable'));
		}
		
		$('.vote').live('click', function(){
				id = $(this).attr('id');
				button = $(this);
				
				$.post("addVote.php5", {id: id}, function(){
						loadGames('topGames', 15, $('#topGamesTable'));
						loadGames('lastVotes', 10, $('#lastVotesTable'));
						loadGames('lastGames', 10, $('#lastGamesTable'));
						if(button.parents('#searchResult').length)
						{
							launchSearch();
						}
				});
		});
		
		$('#languageList').change(function(){
				$('#languageSelect').submit();
		});
		
		$('#linkAdd').click(function(){
				$('#addForm').toggleClass('hidden');
				$("#result").html('');
				
				$('#titleAdd').val('');
				$('#consolesAdd').val('nes');
				$('#consolesOtherAdd').val('');
				$('#genresAdd').val('action-adventure');
				$('#alternatesAdd').val('');
				
				$('#consolesOtherAddParagraph').addClass('hidden');                                                                                              
				$('#submitReallyAdd').addClass('hidden');
				$('#submitAdd').removeClass('hidden');
				$('#formItself').removeClass('hidden');
				
				$("#result").css('border', '');
		});
		
		$('#consolesAdd').change(function(){
				if($(this).val() == 'other')
				{
					$('#consolesOtherAddParagraph').removeClass('hidden');
				}
				else
					$('#consolesOtherAddParagraph').addClass('hidden');
		});
		
		$('#consolesSearch').change(function(){
				if($(this).val() == 'other')
				{
					$('#consolesOtherSearch').removeClass('hidden');
				}
				else
					$('#consolesOtherSearch').addClass('hidden');
		});
		
		$('#titleSearch,#consolesOtherSearch').focus(function(){
				if($(this).val() == $(this).attr('title'))
					$(this).val('');
		});
		
		$('#addForm').submit(function(){
				var title = trim($('#titleAdd').val());
				var cons = $('#consolesAdd').val();
				var consOther = trim($('#consolesOtherAdd').val());
				var genre = $('#genresAdd').val();
				var alternates = $('#alternatesAdd').val();
				
				if(title == '')
				{
					blink('#titleAdd', 1, 5);
					return false;
				}
				
				if(cons == 'other' && consOther == '')
				{
					blink('#consolesOtherAdd', 1, 5);
					return false;
				}
				
				if(trim($('#captchaAdd').val()) != '42')
				{
					blink('#captchaAdd', 1, 5);
					return false; 
				}
				
				if(cons == 'other')
					cons = consOther;
				
				if($("#maybeAlready").length)
					force = "true";
				else
					force = "false";
				
				$.post("add.php5", { title: title, console: cons, genre: genre, alternates: alternates, force: force }, function(data){
						$("#result").queue(function() {
								$("#result").html(data);
								$("#result").css('border', '2px solid black');
								
								if($("#gameAdded").length || $("#already").length)
									$('#addForm').toggleClass('hidden');
								else if($("#maybeAlready").length)
								{
									$('#submitReallyAdd').removeClass('hidden');
									$('#submitAdd').addClass('hidden');
									$('#formItself').addClass('hidden');
								}
								
								if($("#gameAdded").length)
								{
									loadGames('topGames', 15, $('#topGamesTable'));
									loadGames('lastVotes', 10, $('#lastVotesTable'));
									loadGames('lastGames', 10, $('#lastGamesTable'));
								}
								$("#result").dequeue();
						});
				});
				return false;
		});
		
		$('#searchForm').submit(function(){
				launchSearch();
				
				return false;
		});
		
		$('.titleClick').live('click', function(){
				$('#titleSearch').val($(this).text());
				$('#consolesSearch').val('none');
				$('#genresSearch').val('none');
				$('#addForm').add('hidden');
				launchSearch();
		});
})
