## Using JSON

JSON (JavaScript Object Notation) is a portable and well proven format for encapsulating structured data. Therefore it makes sense to include it in the protocol to make it easier for the clients to parse the data.

To enable JSON output, provide `+JSON` to a function that supports it. For example:

~~~~
  C:  FETCH alice@domain.com/INBOX#74d273d2-15c6-4420-81c1-1ae7edbcf3fe +JSON +PRETTY
  S:  ??? Message follows (Pretty Print)
  S:  {
  S:    'envelope': {
  S:      'from': 'bob@domain.com',
  S:      'to': 'alice@domain.com',
  S:      'received': {
  S:      } 
  S:    },
  S:    'parts': [
  S:      { 'id':'body', 'class':'content', 'type':'text/html', 'length':1394, 'encoding':'base64', 'data':'...' },
  S:      { 'id':'img_logo', 'type':'image/png', 'length':16354, 'encoding':'base64', 'data':'...' }
  S:    ]
  S:  }
  S:  ...
~~~~
