import requests
from bs4 import BeautifulSoup
import nltk
import re
import sys

# url = "https://www.javatpoint.com/data-science"
url = "https://realpython.com/html-css-python/"

def url_parse_re(url):
    r = requests.get(url)
    html_content = r.text

    soup = BeautifulSoup(html_content, 'html.parser')

    # Get all headlines
    headlines = [tag.get_text() for tag in soup.find_all(['h1', 'h2', 'h3', 'h4', 'h5', 'h6'])]

    # Get text from all <p> tags and list tags.
    p_tags = soup.find_all(['p', 'ul', 'table', 'code'])
    # Get the text from each of the “p” and "ul" tags and strip surrounding whitespace.
    p_tags_text = [tag.get_text().strip() for tag in p_tags]

    # Filter out sentences that contain newline characters '\n' or don't contain periods.
    sentence_list = [sentence for sentence in p_tags_text if not '\n' in sentence]
    sentence_list = [sentence for sentence in sentence_list if '.' in sentence]

    # Combine list items into string.
    article = ' '.join(sentence_list)

    # Combine headlines into string.
    headlines_text = ' '.join(headlines)

    # Combine article and headlines into a single string.
    text = headlines_text + ' ' + article

    return text

print(url_parse_re(url))
