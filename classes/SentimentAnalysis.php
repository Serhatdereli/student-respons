<?php

class SentimentAnalysis
{
	const MONKEY_LEARN_API_KEY = 'b709e2c173ee597480c300c43259660d98960ac1';
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
		$ml = self::getMonkeyLearn();
		$response = $ml->classifiers->classify(self::MONKEY_LEARN_MODULE, $text_list, true);

		$result = $response->result[0][0];

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