#include <iostream>
#include <fstream>
#include <algorithm>
#include <string>
#include <unordered_map>
using namespace std;
int main(){
	ofstream outFile;
	ifstream inFile;

	inFile.open("rawFile.txt");
	//outFile.open("C:\\Users\\AJ\\Desktop\\fEMREntireProject\\adminPage\\cities.sql");
	outFile.open("processed.sql");
	string cityName;
	unordered_map<string, char> testMap;
	outFile << "INSERT INTO femr.citytest VALUES (";
	while(inFile.good()){
		getline(inFile, cityName, ',');
		inFile.ignore(10000, '\n');
		pair<string, char> yoo (cityName, 'z');
		
		unordered_map<string, char>::const_iterator got = testMap.find(cityName);
		//cout << cityName;
		if(got == testMap.end())
		{
			outFile << '\'' + cityName + "\',";
			outFile << "\n";
			testMap.insert(yoo);
		}
	}
	outFile << ")";
	//input.erase(std::remove(input.begin(), input.end(), ','), input.end());
	outFile.close();
	inFile.close();
	//cout << input;
	return 0;
}