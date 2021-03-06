<?php
class Suit {

	public $suit;
	public $index;
	public $symbol;
	function __construct($suitstr, $firstletter, $idx) 
	{
		$this->suit = $suitstr;
		$this->index = $idx;
		$this->symbol = $firstletter;
	}
}
class Rank {

	public $face;
	public $symbol;
	public $value_28;
	public $value_n;
	public $index;
	function __construct($namestr, $val, $offset, $val_28) 
	{
		$this->value_28 = $val_28;
		$this->value_n = $offset+1;
		$this->index = $offset;
		$this->face = $namestr;
		$this->symbol = $val;
	}
}

class Card {

	public $suit;
	public $rank;
	public $index;
	function __construct($suitobj, $rankobj, $CARDPERSUIT=13) 
	{
		$this->suit = $suitobj;
		$this->rank = $rankobj;
		$this->index = ($suitobj->index * $CARDPERSUIT) + $rankobj->index;
	}
	
	function display()
	{
		print $this->rank->face;
		print $this->suit->suit;
		print "\n";
	}
}

class Player {
	public $cardset;
	public $player_name;
	public $player_id;
	public $unique_id;
	public $position;
	public $teamid;
	public $setid;
	public $points;
	public $bid;
	function __construct($name, $id, $unqid) 
	{
		$this->player_name = $name;
		$this->player_id = $id;
		$this->unique_id = $unqid;
		$this->cardset = array();
		$this->position =100;
		//print "Player:$name with ID:$id joined";
		$this->points=0;
	}
	public function addToPlayerHand($card)
	{
		array_push($this->cardset, $card);
	}	
	public function removefromPlayerHand($card)
	{
		$index=array_search($card, $this->cardset);
		if ($index)
			unset($this->cardset[$index]);
	}
	public function arrayToStr()
	{
		$str="";
		foreach($this->cardset as $k)
		{
			$str= $str.$k->index." ";
		}
		return $str;
	}
	public function printCardIndices()
	{
		print "Player:$this->player_name and ID:$this->player_id \n";
		foreach($this->cardset as $k)
		{
			print $k->index;
			print " ";
		}
		print "\n";
	}
	public function getCardByIndex($index)
	{
		foreach($this->cardset as $k)
		{
			if ($k->index == $index)
				return $k;
		}
		return null;
	}

}
class Deck {

	public $cardArr = array();
	public $suitArr = array();
	public $rankArr = array();
	public static $CLUBS ;
	public static $DIAMONDS;
	public static $HEARTS;
	public static $SPADES;
	public static $TOTAL;
	public static $CARDPERSUIT;
	function __construct() 
	{
		$TOTAL=52;
		$CARDPERSUIT=13;

		$CLUBS = new Suit( "Clubs", "c" , 0);
		array_push($this->suitArr, $CLUBS);
		$DIAMONDS = new Suit( "Diamonds", "d" , 1);
		array_push($this->suitArr, $DIAMONDS);
		$HEARTS = new Suit( "Hearts", "h" , 2);
		array_push($this->suitArr, $HEARTS);
		$SPADES = new Suit( "Spades", "s", 3);
		array_push($this->suitArr, $SPADES);

		$ACE = new Rank( "Ace", "a" , 0, 1);
		$TWO = new Rank( "Two", "2" , 1, 10);
		$THREE = new Rank( "Three", "3", 2, 5);
		$FOUR = new Rank( "Four", "4" , 3, 0);
		$FIVE = new Rank( "Five", "5" , 4, 0);
		$SIX = new Rank( "Six", "6" , 5, 0);
		$SEVEN = new Rank( "Seven", "7" , 6, 0);
		$EIGHT = new Rank( "Eight", "8" , 7, 0 );
		$NINE = new Rank( "Nine", "9" , 8, 2);
		$TEN = new Rank( "Ten", "t" , 9, 1);
		$JACK = new Rank( "Jack", "j" , 10, 3);
		$QUEEN = new Rank( "Queen", "q" , 11, 0);
		$KING = new Rank( "King", "k" , 12, 0);

		array_push($this->rankArr, $ACE);
		array_push($this->rankArr, $TWO);
		array_push($this->rankArr, $THREE);
		array_push($this->rankArr, $FOUR);
		array_push($this->rankArr, $FIVE);
		array_push($this->rankArr, $SIX);
		array_push($this->rankArr, $SEVEN);
		array_push($this->rankArr, $EIGHT);
		array_push($this->rankArr, $NINE);
		array_push($this->rankArr, $TEN);
		array_push($this->rankArr, $JACK);
		array_push($this->rankArr, $QUEEN);
		array_push($this->rankArr, $KING);
	}
	
	public function printValues()
	{
		foreach($this->cardArr as $obj)
		{
			print $obj->rank->face;
			print $obj->suit->suit;
			print "\n";
		}	
	}
	
	public function deckShuffle()
	{
		shuffle($this->cardArr);
		shuffle($this->cardArr);
	}
	
	
	public function generateCardDeck()
	{
		foreach ($this->suitArr as $suit)
		{
			foreach ($this->rankArr as $rank)
			{
				$card = new Card($suit, $rank);	
				array_push($this->cardArr, $card);
			}
		}

	}
	public function printCardIndices()
	{
		foreach($this->cardArr as $k)
		{
			print $k->index;
			print " ";
		}
		print "\n";
	}
}

class Trump {
	public $deckobj;
	public $playerArr;
	public $trump;
	public $setArr;
	public $roundArr;
	public static $PLAYERS;
	public static $CARDPERUSER;
	public static $token;
	public static $cur_player;
	public static $round;
	public $current_bid=0;
	public $trump_holder;	
	public $trump_revealed;	
	function __construct()
	{
		$this->PLAYERS=4;
		$this->CARDPERUSER=13;
		$this->deckobj = new Deck();
		$this->deckobj->generateCardDeck();
		$this->playerArr=array();
		$this->setArr=array();
		$this->roundArr=array();
		//$this->deckobj->printCardIndices();
		$this->deckobj->deckShuffle();
		//$deckobj->printValues();
		$this->trump=$this->deckobj->cardArr[51];
		$this->token=0;
		$this->cur_player=0;
		$this->round=0;
		$this->trump_revealed = false;	
	}
	public function generatePlayerHand($player)
	{
		$setid = $this->getFreeSetId();
		$start= ($this->CARDPERUSER * $setid);
		$end = $start + $this->CARDPERUSER;
		for ($i=$start;$i<$end;$i++)
		{
			$player->addToPlayerHand($this->deckobj->cardArr[$i]);	
		}
		$player->setid=$setid;
		array_push($this->setArr, $setid);
	}
	
	public function getFreeSetId()
	{
		for($i=0; $i<$this->PLAYERS;$i++)
		{
			if (!in_array($i, $this->setArr))
				return $i;
		}
		return -1;
	}

	public function removeSetId($id)
	{
		foreach ($this->setArr as $key => $elem)
		{
			if ($elem == $id)
			{
				unset($this->setArr[$key]);
				$this->setArr=array_values($this->setArr);
				return;
			}
		}
	}
	public function addUser($name, $id, $unqid)
	{
		$cardStr="";
		//print count($this->playerArr)."\n";
		if (count($this->playerArr) < $this->PLAYERS)
		{
			$key = $this->getPlayerIndexById($name, $unqid);
			if ($key >=0)
			{
				$player = $this->playerArr[$key];
			}
			else
			{
				$player= new Player($name, $id, $unqid);
				array_push($this->playerArr, $player);
				$cardArr = $this->generatePlayerHand($player);
			}
			//$player->printCardIndices();
			$cardStr="CARDS:". $player->arrayToStr();
		}
		//print count($this->playerArr)."\n";
		return $cardStr;
	}

	public function getPlayerIndexById($name, $unqid)
	{
		foreach ($this->playerArr as $key => $k)
		{
			if($k->unique_id == $unqid || $k->player_name == $name)
			{
				//print "Key:$key";
				return $key;
			}
		}
		return -1;
	}

	public function removeUser($name, $id, $unqid)
	{
		$index = $this->getPlayerIndexById($name, $unqid);
		if ($index>=0)	
		{
		//	print "Delete Entered\n";
			$player =$this->playerArr[$index];
			$this->removeSetId($player->setid);
			unset($this->playerArr[$index]);
			$this->playerArr=array_values($this->playerArr);
			unset($player);
		}
		//print count($this->playerArr)."\n";
	}	
	public function setUserPosition($name, $position)
	{
		$key = $this->getPlayerIndexById($name, "dummy");
		$player =$this->playerArr[$key];
		$player->position=$position;
		//print "SET PLAYER POS:$player->position\n";
		$player->teamid=$position%2;
	}
	
	public function isPlayerPositionSet($name, $unqid)
	{

		$key = $this->getPlayerIndexById($name, $unqid);
		$player =$this->playerArr[$key];
		$pos = $player->position;
		//print "GET PLAYER POS:$player->position\n";
		return $pos;
	}
	public function getTakenPositions()
	{
		$str="TAKEN: ";
		//$str="TAKEN:100 ";
		foreach($this->playerArr as $player)
		{
			if ($player->position != 100)
				$str= $str.$player->position." ";
		}
		return $str;
	}
	
	public function playerCountReached()
	{
		if (count($this->playerArr) == $this->PLAYERS)
			return true;
		else
			return false;
	}

	public function getPlayerByPosition($position)	
	{
		foreach($this->playerArr as $player)
		{
			if ($player->position == $position)
				return $player;
		}
		return null;
	}
	public function setPlayerBid($bid, $pos)
	{
		if ($bid > $this->current_bid)
		{
			$this->current_bid=$bid;
			$this->trump_holder=$this->getPlayerByPosition($pos);
			$this->trump_holder->bid=$bid;
		}
	}
	
	public function addCardToRound($player_pos, $id, $index)
	{
		$player = $this->getPlayerByPosition($player_pos);
		$card = $player->getCardByIndex($index);		
		array_push($this->roundArr, $card);
	}
	
	public function setNextPlayer()
	{
		$topcard = $this->roundArr[0];
		$highest = $topcard->rank->value_n;
		$i=0;
		$totalroundvalue=0;
		$highsuit = $topcard->suit;
		foreach ($this->roundArr as $cur) {
			$cursuit = $cur->suit;
			$currank = $cur->rank->value_n;
			if ($cursuit == $highsuit) {
				if ($currank >= $highest) {
					print "HIGHEST: $highest \n";
					$highest = $currank;
					$highindex = $i;		
					$highsuit = $cursuit;
				}
				print "Current=";
				$cur->display();
				print "\t Highest:";
				$this->roundArr[$highindex]->display();
			}
			else {
				if ($this->trump_revealed) {	
					if ($cursuit == $this->trump->suit)
					{
						$highest = $currank;
						$highindex = $i;		
						$highsuit = $cursuit;
					}	
				}
			}
			$totalroundvalue += $currank;
			$i++;
		}
		print "ROUND VALUE:$totalroundvalue\n";
		$temp = ($highindex+$this->cur_player)% $this->PLAYERS;
		print "NEXT PLAYER = $temp";
		$this->cur_player = $temp;
		
		
		for($j=0; $j<$this->PLAYERS; $j++)
			array_pop($this->roundArr);

		$player = $this->getPlayerByPosition($this->cur_player);		
		$player->points+=$totalroundvalue;
	}
	
	public function getScore()
	{
		$team1=0;
		$team2=0;
		foreach($this->playerArr as $player) {
			if ($player->position %2 == 0)
				$team1 +=$player->points;
			else
				$team2 +=$player->points;
		}
		return "ROUND:".$team1." ".$team2;

	}
}

?>
