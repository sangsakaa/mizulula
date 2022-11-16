import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:my_app/screens/detailsiswa.dart';

class Homepage extends StatelessWidget {
  const Homepage({
    Key? key,
  }) : super(key: key);

  final String url = 'https://wustho.smedi.my.id/api/siswa';
  Future getNis() async {
    var response = await http.get(Uri.parse(url));
    // print(json.decode(response.body));
    return json.decode(response.body);
  }

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'SMEDI',
      home: Scaffold(
          appBar: AppBar(
            title: const Text('SMEDI'),
          ),
          body: FutureBuilder(
            future: getNis(),
            builder: (context, snapshot) {
              if (snapshot.hasData) {
                return ListView.builder(
                    itemCount: snapshot.data['siswa'].length,
                    itemBuilder: (context, index) {
                      return Container(
                        padding: const EdgeInsets.all(2.0),
                        height: 120,
                        child: Card(
                          elevation: 5,
                          child: Row(
                            children: [
                              Expanded(
                                child: GestureDetector(
                                  onTap: () {
                                    Navigator.push(
                                        context,
                                        MaterialPageRoute(
                                            builder: (context) => DetailSiswa(
                                                  siswa: snapshot.data['siswa']
                                                      [index],
                                                )));
                                  },
                                  child: Container(
                                    // ignore: prefer_const_constructors
                                    padding: EdgeInsets.all(2.0),
                                    child: Column(
                                      mainAxisAlignment:
                                          MainAxisAlignment.spaceEvenly,
                                      children: [
                                        const Align(
                                            alignment: Alignment.topCenter,
                                            child: Text('Nama Lengkap : ')),
                                        Text(
                                          snapshot.data['siswa'][index]
                                              ['nama_siswa'],
                                          // ignore: prefer_const_constructors
                                          style: TextStyle(
                                              fontSize: 15.0,
                                              fontWeight: FontWeight.bold),
                                        ),
                                      ],
                                    ),
                                  ),
                                ),
                              ),
                            ],
                          ),
                        ),
                      );
                    });
              } else {
                return const Text('Tidak Ada Jaringan');
              }
            },
          )),
    );
  }
}
