<?php

class SentimentAnalysis
{
	const MONKEY_LEARN_API_KEY = 'c12683a266a33b60297c619488b6d8b594cf2d42';
	const MONKEY_LEARN_MODULE = 'cl_qkjxv9Ly';

	const SENTIMENT_POSITIVE = 1;
	const SENTIMENT_NEGATIVE = 2;
	const SENTIMENT_NEUTRAL = 0;

	public static $monkey_learn = null;

	public static function getMonkeyLearn()
	{
		if (is_null(self::$monkey_learn))
		{
			self::$monkey_learn = new MonkeyLearn\Client(self::MONKEY_LEARN_API_KEY);
		}
		return self::$monkey_learn;
	}

	public static function analyseText($text)
	{
		// TODO: DO SOME VALIDATION
		$text_list = array($text);

		$cache_key = md5($text);
		$result = TempCache::get($cache_key);
		if (is_null($result))
		{
			$ml = self::getMonkeyLearn();
			$response = $ml->classifiers->classify(self::MONKEY_LEARN_MODULE, $text_list, true);
			$result = $response->result[0][0];
			TempCache::put($cache_key, $result, 3600 * 24);
		}
		$label = $result['label'];
		switch ($label)
		{
			case 'negative':
				return self::SENTIMENT_NEGATIVE;
			case 'positive':
				return self::SENTIMENT_POSITIVE;
		}

		return self::SENTIMENT_NEUTRAL;
	}
}