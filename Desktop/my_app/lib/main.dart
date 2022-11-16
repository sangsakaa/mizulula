import 'package:flutter/material.dart';
import 'package:my_app/screens/homepage.dart';

void main() {
  runApp(myapp());
}

class myapp extends StatelessWidget {
  const myapp({
    Key? key,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Homepage();
  }
}
