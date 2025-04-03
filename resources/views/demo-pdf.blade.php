<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Sample</title>
	<style>
		* {
			margin: 0;
			padding: 0;
		}
		body {
			font-family: 'Times New Roman', Times, serif;
		}
		.text-center { text-align: center; }
		.mb-0 { margin-bottom: 0; }
		.underline { text-decoration: underline }
		.dotted-underline { text-decoration-style: dotted;  }
	</style>
</head>
<body>
	<div style="padding-top: 16px; padding-bottom: 16px;">
		<div class="header">
			<div class="text-center">
				<h3 style="line-height: 0.4">GOVERNMENT OF ASSAM</h3>
				<h3 style="line-height: 0.4">DEPARTMENT OF …………………………</h3>
				<h3 class="underline" style="line-height: 0.4">DISPUR, GUWAHATI-781006</h3>
			</div>
			
			
			<table style="width: 100%; margin-left: auto; margin-right: auto; margin-top: 16px; margin-bottom: 16px;">
				<tr>
					<td>
						No: <span style="border-bottom: 1px dotted #222;">123456777</span>		
					</td>
					<td align="right">
						Dated: <span style="border-bottom: 1px dotted #222;">123456777</span>	
					</td>
				</tr>
			</table>

			<h3 class="underline text-center" style="margin-bottom: 16px">ORDER</h3>

			<div style="margin-bottom: 16px;">
				<p style="text-indent: 50px; margin-bottom: 0px;">As per recommendation of the State Level Recruitment Commission for Class III Posts/ State Level Recruitment Commission for Class IV Posts/ State Level Police Recruitment Board/ Recruitment Board of Health & FW Department / Selection Committee (strike out that is not applicable), the following candidate(s) is/are appointed to the post(s) and vacancy(ies) as shown below against his/her name with effect from the date of joining in the scale of pay as shown below, subject to fulfilment of the following terms and conditions and subject to satisfactory Notarized Affidavit submitted by the candidates as per the Personnel (B) Department O.M. No. ABP.78/2021/01, dated 18/11/2021 in the format prescribed therein regarding character and antecedents and subject to satisfactory verification of documents and undertakings submitted by the candidates(s).</p> 
				<p style="text-indent: 50px;">The candidates so appointed will not be governed by the existing Assam Services (Pension) Rules, 1969 and orders issued thereunder from time to time. They will be governed by a new set of Pension Rules under the "New Defined Contribution Pension Scheme".</p>
			</div>

			<table style="width: 100%; margin-left: auto; margin-right: auto; margin-top: 10px; margin-bottom: 30px; border: 1px solid #222; border-collapse:collapse">
				<thead>
					<tr>
						<th style="border: 1px solid #222">Sl No.</th>
						<th style="border: 1px solid #222">Name and Address of the Candidate</th>
						<th style="border: 1px solid #222">Roll No.</th>
						<th style="border: 1px solid #222">Names of the Post</th>
						<th style="border: 1px solid #222">Scale of Pay</th>
						<th style="border: 1px solid #222">Name of Office with vacancy against which the candidate is appointed and posted</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style="border: 1px solid #222" align="center">{{ $serialNo }}</td>
						<td style="border: 1px solid #222" align="center">{{ $name }} <br /> {{ $address }}</td>
						<td style="border: 1px solid #222" align="center">{{ $rollNo}}</td>
						<td style="border: 1px solid #222" align="center">{{ $postName }}</td>
						<td style="border: 1px solid #222" align="center">{{ $payscale }}</td>
						<td style="border: 1px solid #222" align="center">{{ $office }}</td>
					</tr>
				</tbody>
			</table>

			<p style="font-weight: bold; margin-bottom: 10px;">The following are the Terms and Conditions of service for the appointee:</p>

			<ol style="margin-left: 16px;">
				<li>During his/her service period, he/she may be deputed or his/her services may be placed on attachment or on secondment basis to any other department/ sub-ordinate office/ public sector undertaking / society/ Mission under the State Govt. within and outside the State having the same pay scale and Grade pay for a period decided and specified by the State Govt. <br />
				While on such Deputation or on attachment or placed on Secondment basis he/she shall continue to be guided by the Assam Civil Services (Conduct) Rules, 1965 and Assam Services (Discipline & Appeal) Rules, 1964.</li>
				<li>The services of any selected candidate found to have furnished false/ falsified information regarding educational qualification/ caste/ gender/ EWS status etc. in his/ her application and detected subsequently, will be terminated and legal action will also be taken as per law.</li>
				<li>Any selected candidate for Class IV Post found to be overqualified/found to have suppressed information about over educational qualification, in terms of the advertisement during entry in the service, his/her service will be terminated and also legal action will be taken as per norms.</li>
				<li>If a Candidate or any of his/her family members is availing benefits under the Orunodoi Scheme at the time of the appointment, he/she or the concerned family member shall voluntarily opt out of the Scheme, as per Orunodoi Guidelines for getting appointment to the post.</li>
			</ol>
		</div>

	</div>
</body>
</html>