import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';

class CallApi {
  final String _url = 'http://127.0.0.1:8000/';

  postData(data, apiUrl) async {
    var token = await _getToken();
    var fullUrl = _url + apiUrl;
    return await http.post(Uri.parse(fullUrl),
        body: jsonEncode(data), headers: _setHeaders(token));
  }

  putData(data, apiUrl) async {
    var token = await _getToken();
    var fullUrl = _url + apiUrl;
    return await http.put(Uri.parse(fullUrl),
        body: jsonEncode(data), headers: _setHeaders(token));
  }

  getData(apiUrl) async {
    var token = await _getToken();
    var fullUrl = _url + apiUrl;
    return await http.get(Uri.parse(fullUrl), headers: _setHeaders(token));
  }

  _setHeaders(token) => {
        'Content-type': 'application/json',
        'Accept': 'application/json',
        'Authorization': "Bearer $token"
      };

  _getToken() async {
    SharedPreferences localStorage = await SharedPreferences.getInstance();
    return localStorage.getString('token');
  }
}
