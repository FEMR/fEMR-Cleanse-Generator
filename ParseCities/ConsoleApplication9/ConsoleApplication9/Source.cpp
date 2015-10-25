#include <iostream>
#include <fstream>
#include <algorithm>
#include <string>
#include <unordered_map>
using namespace std;
<<<<<<< HEAD
void transfertoSql(string countryName)
{
	//skip first two commas grab city, put into hash, if exists, skip rest, no, insert then skip next three commas,  grab lat, then long
	ifstream inFile;
	ofstream outFile;
	inFile.open("C:\\Users\\212433740\\Desktop\\fEMR Group Project\\fEMRProject(ap)\\ADMIN PAGE\\cityDump\\processed\\" + countryName + ".txt");
	outFile.open("C:\\Users\\212433740\\Desktop\\fEMR Group Project\\fEMRProject(ap)\\ADMIN PAGE\\cityDump\\processed\\sql\\" + countryName + ".txt");
	string cityName;
	unordered_map<string, char> testMap;
	outFile << "INSERT INTO femr.mission_cities VALUES ";
	while (inFile.good()){
		getline(inFile, cityName, ',');
		getline(inFile, cityName, ',');
		getline(inFile, cityName, ',');
		inFile.ignore(10000, '\n');
		pair<string, char> yoo(cityName, 'z');

		unordered_map<string, char>::const_iterator got = testMap.find(cityName);
		//cout << cityName;
		if (got == testMap.end())
		{
			outFile << "(\'" + cityName + "\',";
			if (countryName == "do")
				outFile << "\'49\'),\n";
			else if (countryName == "ec")
				outFile << "\'51\'),\n";
			else if (countryName == "et")
				outFile << "\'57\'),\n";
			else if (countryName == "gh")
				outFile << "\'65\'),\n";
			else if (countryName == "ht")
				outFile << "\'72\')\n,";
			else if (countryName == "in")
				outFile << "\'76\'),\n";
			else if (countryName == "ke")
				outFile << "\'88\'),\n";
			testMap.insert(yoo);
		}
	}
	/*INSERT INTO femr.citytest VALUES('Abacou'),
		('Abeille'),
		('Abicot'),
		('Aboni')*/


}
void processFile(string countryName)
{
	ifstream inFile;
	ofstream outFile;
	inFile.open("worldcitiespop.txt");
	outFile.open("C:\\Users\\212433740\\Desktop\\fEMR Group Project\\fEMRProject(ap)\\ADMIN PAGE\\cityDump\\processed\\" + countryName + ".txt");
	string input;
	string restOfRow;
	while (inFile.good())
	{
		getline(inFile, input, ',');
		if (countryName == input)
		{
			getline(inFile, restOfRow, '\n');
			outFile << input + ',' + restOfRow + '\n';
		}
		else
			inFile.ignore(10000, '\n');
	}
	inFile.close();
	outFile.close();
}
int main(){
	ofstream outFile;
	ifstream inFile;
	//processFile("ht");
	//processFile("do");
	//processFile("ec");
	//processFile("et");
	//processFile("gh");
	//processFile("in");
	//processFile("ke");
	//transfertoSql("ht");
	transfertoSql("do");
	transfertoSql("ec");
	transfertoSql("et");
	transfertoSql("gh");
	transfertoSql("in");
	transfertoSql("ke");

=======
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
>>>>>>> 4f95bdf1a0e0abd95e4cdb091b9a1baf79a5d190
	return 0;
}