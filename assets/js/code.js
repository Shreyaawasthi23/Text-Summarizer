async function query(data) {
	
	const response = await fetch(
		"https://api-inference.huggingface.co/models/philschmid/distilbart-cnn-12-6-samsum",

		{
			headers: { Authorization: "Bearer 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" },
			method: "POST",
			body: JSON.stringify(data),
		}
	);
	const result = await response.json();
	return result;
}
//"https://api-inference.huggingface.co/models/facebook/bart-large-cnn",