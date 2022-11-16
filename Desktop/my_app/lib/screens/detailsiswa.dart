import 'package:flutter/material.dart';

class DetailSiswa extends StatelessWidget {
  final Map siswa;

  const DetailSiswa({super.key, required this.siswa});
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(
          "Detail Siswa",
        ),
      ),
      body: Column(children: [
        Container(
          child: Center(
            child: Padding(
              padding: const EdgeInsets.all(8.0),
              child: Text(
                siswa['nis'],
                style: TextStyle(fontSize: 20.0, fontWeight: FontWeight.bold),
              ),
            ),
          ),
        ),
        SizedBox(
          height: 10,
        ),
      ]),
    );
  }
}
