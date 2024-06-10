from flask import Flask, make_response, jsonify, request as req
from p1 import url_parse_re
from bs4 import BeautifulSoup

app = Flask(__name__)


@app.route("/analyse")
def analyse():
	# url = 'https://www.javatpoint.com/data-science'
	urlString = req.args.get('url', 'https://www.javatpoint.com/data-science')
	url = urlString
	text = url_parse_re(url)
	js = jsonify({'result':text})
	response = make_response(text)
	response.headers['Content-Type'] = 'text/plain'
	return response

if __name__ == "__main__":
    app.run(host='0.0.0.0', port = 8080, debug=True)