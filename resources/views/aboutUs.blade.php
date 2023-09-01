<html lang="en">
<!--HEADER -->
@include('head')

<!-- About Us -->
<div>
	<div class="my-3" style="">
		<div class="text-center">
			<img src="{{asset('assets/imgs/southsignalLogoLeft.png')}}" class="img-fluid" alt="..." />
		</div>

		<h1 class="display-6 text-center" style="color: #AA0F0A;">ABOUT BARANGAY SOUTH SIGNAL VILLAGE</h1>
		<h1 class="text-center mt-3 font-weight-bold fs-1" style=" color:#AA0F0A;">History</h1>
		<hr style="height: 2.5px; opacity: 100; color: black;" />
		<figure class="text-center">
			<blockquote class="blockquote mx-5">
				<p style="font-size: smaller; " class="text-break">
					Barangay Signal Village was divided into four (4) barangays namely; BARANGAY SOUTH SIGNAL VILLAGE, Barangay Central Signal Village, Barangay Katuparan and Barangay North Signal Village, pursuant to Section 385 and
					386 of RA 7160 otherwise known as The Local Gov’t Code of the Philippines. The Sangguniang Panlungsod enacted Ordinance No. 60 Series of 2008 subject to the compliance of various requirements, the creation of SOUTH
					SIGNAL VILLAGE composed of areas segregated from other Barangay Signal Village voted in favor of the creation of Barangay South Signal Village which was duly confirmed by the COMELEC Board of Canvassers on December
					19, 2008.<br />
					<br />
					Upon the division of Signal Village, Mr. Pedro “Pete” Sedan was appointed by Mayor Sigfrido “Freddie” R. Tinga as the first Punong Barangay of South Signal Village. But due to health reason Mr. Pedro Sedan was
					replaced by Mrs. Patria M. Dueñas. And on May 2011 the first barangay election was held at South Signal Village and Atty. Henry I. Dueñas Sr. was elected as the Punong Barangay.<br />
					<br />
					And on November 18 2013, the second barangay Election was held and the new set of elected Punong Barangay and Kagawad took their oath in November 27, 2013 at SM Aura, Global City Taguig.<br />
					<br />
					Hon. Michelle Ann M. Odevilas was elected as the second Punong Barangay together with the seven (7) Council Members namely: Kgd. Clarissa Anne L. Solis, Committee on Appropriation, Health and Sanitation; Kgd. Jerome
					P. Sedan, Committee on Youth and Sports Development; Kgd. Kenneth Ian V. Nadela, Committee on Livelihood, Cooperatives and Entrepreneurship; Kgd. Francisco P. Galudo, Committee on Senior Citizens Affairs,
					Transportation and Traffic Management; Kgd. Cerilo B. Pasicolan, Committee on Peace and Order; Kgd. Ariel M. Viray, Committee on Community Development, Ways and Means; and Kgd. Rosario R. Mendoza, Committee on
					Education and Culture, and Women’s Organization and Family Welfare.<br />
					<br />
					On May 14, 2018, Hon. Michelle Ann M. Odevilas was re-elected for the second time together with the new set of Barangay Council Members namely: Kgd. Kenneth Ian V. Nadela, Committee on Livelihood, Cooperatives and
					Entrepreneurship, Kgd. Norman H. Hortilano, Committee on Health and Sanitation, Women’s Organization and Family Welfare and Committee on Education and Culture; Kgd. Glenn V. Daiz, Committee on Ways and Means; Kgd.
					Francisco P. Galudo, Committee on Appropriation and Committee on Community Development, Kgd. Cesar C. Tiglao, Committee on Transportation and Traffic Management, Kgd. Glenn Robert N. Roa, Committee on Peace and
					Order; and Kgd. Geoffrey S. Dubria, Committee on Senior Citizens Affairs and Kgd. Kenneth D. Cañeda SK Chairman Committee on Youth and Sports Development;
				</p>
			</blockquote>
		</figure>

		<h1 class="text-center mt-3 font-weight-bold fs-1" style=" color:#AA0F0A;">Demography</h1>
		<hr style="height: 2.5px; opacity: 100; color: black;" />
		<div class="container">
			<figure class="text-center">
				<blockquote class="blockquote mx-5">
					<div class="row g-5">
						<div class="col-12 col-sm-4">
							<div class="my-3">
								<img src="https://cdn-icons-png.flaticon.com/512/854/854901.png" class="" alt="..." style="height: 100px;" />
								<h6 style="font-size: medium;" class="mt-3">Total Land Area</h6>
								<p style="font-size: smaller;">{{number_format($info[10]->content)}} sq. meters more or less.</p>
							</div>
						</div>
						<div class="col-12 col-sm-4">
							<div class="my-3">
								<img src="https://cdn-icons-png.flaticon.com/512/7158/7158872.png" class="" alt="..." style="height: 100px;" />
								<h6 style="font-size: medium;" class="mt-3">Population</h6>
								<p style="font-size: smaller;">{{number_format($info[11]->content)}} {{ "as of " . (new DateTime($info[11]->updated_at))->format("F j, Y");}}</p>
							</div>
						</div>
						<div class="col-12 col-sm-4">
							<div class="my-3">
								<img src="https://cdn-icons-png.flaticon.com/512/2633/2633848.png" class="" alt="..." style="height: 100px;" />
								<h6 style="font-size: medium;" class="mt-3">Registered Voters</h6>
								<p style="font-size: smaller;">{{number_format($info[12]->content)}} {{ "as of " . (new DateTime($info[11]->updated_at))->format("F j, Y");}}</p>
							</div>
						</div>
					</div>

					<div class="row g-5">
						<div class="col-12 col-sm-4">
							<div class="my-3">
								<img src="https://cdn-icons-png.flaticon.com/512/3079/3079182.png" class="" alt="..." style="height: 100px;" />
								<h6 style="font-size: medium;" class="mt-3">Household</h6>
								<p style="font-size: smaller;">{{number_format($info[13]->content)}} {{ "as of " . (new DateTime($info[11]->updated_at))->format("F j, Y");}}</p>
							</div>
						</div>
						<div class="col-12 col-sm-4">
							<div class="my-3">
								<img src="https://cdn-icons-png.flaticon.com/512/176/176844.png" class="" alt="..." style="height: 100px;" />
								<h6 style="font-size: medium;" class="mt-3">No. of puroks</h6>
								<p style="font-size: smaller;">{{number_format($info[14]->content)}} </p>
							</div>
						</div>
						<div class="col-12 col-sm-4">
							<div class="my-3">
								<img src="https://cdn-icons-png.flaticon.com/512/748/748690.png" class="" alt="..." style="height: 100px;" />
								<h6 style="font-size: medium;" class="mt-3">No. of streets</h6>
								<p style="font-size: smaller;">{{number_format($info[15]->content)}}</p>
							</div>
						</div>
					</div>

					<div class="row g-5">
						<div class="col-12 col-sm-12">
							<div class="my-3">
								<img src="https://cdn-icons-png.flaticon.com/512/7309/7309109.png" class="" alt="..." style="height: 100px;" />
								<h6 style="font-size: medium;" class="mt-3">No. of Polling Precincts</h6>
								<p style="font-size: smaller;">{{number_format($info[16]->content)}} {{ "as of " . (new DateTime($info[11]->updated_at))->format("F j, Y");}}</p>
							</div>
						</div>
					</div>
				</blockquote>
			</figure>
		</div>

		<h1 class="text-center mt-3 font-weight-bold fs-1" style=" color:#AA0F0A;">Vision</h1>
		<hr style="height: 2.5px; opacity: 100; color: black;" />

		<figure class="text-center">
			<blockquote class="blockquote mx-5 text-break">
				<p class="lh-lg">
					South Signal Village is an environment-friendly barangay where people are God-fearing, healthy and disciplined who are united together for a common purpose of attaining a progressive economy, resilient and peaceful
					environment for the welfare of the future generation, under the strong and inclusive governance.
				</p>
				<p class="lh-lg">
					<i>
						Ang Barangay South Signal Village ay isang maka-kalikasang pamayanan ng mga taong Maka-Diyos, malusog, may kapanutuhan at nagkaka-isa sa tanging layunin na makamit ang isang maunlad na pamumuhay, matatag at
						tahimik na kapaligiran para sa ikabubuti ng mga susunod na salin-lahi sa ilalim ng isang matibay, at pantay-pantay na pamunuan.
					</i>
				</p>
			</blockquote>
		</figure>

		<h1 class="text-center mt-3 font-weight-bold fs-1" style=" color:#AA0F0A;">Mission</h1>
		<hr style="height: 2.5px; opacity: 100; color: black;" />

		<figure class="text-center">
			<blockquote class="blockquote mx-5 text-break">
				<p class="lh-lg">To become a role model of all barangay in the aspect of Peace and Order, Health and Sanitation and Education through community participation.</p>
				<p class="lh-lg">
					<i>Upang maging isang natatanging halimbawa ng lahat ng mga barangay sa larangan ng kapayapaan at kaayusan, kalusugan at kalinisan at edukasyon sa pamamagitan ng sama-samang pagkilos ng sambayanan.</i>
				</p>
			</blockquote>
		</figure>
		<br />
		<h1 class="text-center mt-3 font-weight-bold fs-1" style=" color:#AA0F0A;">Objectives</h1>
		<hr style="height: 2.5px; opacity: 100; color: black;" />

		<figure class="">
			<blockquote class="blockquote mx-5">
				<ol class="list-group list-group-numbered ms-3">
					<li class="list-group-item lh-lg border-0">To reduce crime rates and maintain peace and order in the community through community policing and anti-drug campaigns.</li>
					<li class="list-group-item lh-lg border-0">To improve access to healthcare and promote health and sanitation, through campaigns on hygiene, vaccination, and healthy lifestyle choices.</li>
					<li class="list-group-item lh-lg border-0">
						To increase the literacy rate by establishing information and reading center and promote education through initiatives such as scholarship programs, after-school tutoring, adult literacy classes.
					</li>
					<li class="list-group-item lh-lg border-0">To preserve and protect the environment through waste segregation and recycling, urban gardening, composting and conservation efforts, and green energy initiatives.</li>
					<li class="list-group-item lh-lg border-0">To promote economic development and progress through entrepreneurship and skills training, job creation, and investment attraction.</li>
					<li class="list-group-item lh-lg border-0">To encourage active participation and involvement of community members in decision-making processes assemblies and community projects.</li>
					<li class="list-group-item lh-lg border-0">
						To foster a sense of unity and togetherness among community members through regular meetings and events, and by promoting values such as respect, discipline, and God-fearing behavior.
					</li>
					<li class="list-group-item lh-lg border-0">
						To provide for resolution of disputes at the barangay level in order to achieve peace and harmony within the community and to provide an accessible and effective form of justice for community members thru
						Katarungang Pambarangay
					</li>
				</ol>
			</blockquote>
		</figure>

		<h1 class="text-center mt-3 font-weight-bold fs-1" style=" color:#AA0F0A;">Barangay Officials</h1>
		<hr style="height: 2.5px; opacity: 100; color: black;" />

		<div class="container text-center">
			<div class="row g-5">
				<div class="text-center">
					<div class="my-3">
						<img src="{{asset('adminOfficial/'.$info[0]->file)}}" class="img-fluid rounded-circle" alt="{{$info[0]->content}}" style="height: 100px;" />
						<h6 style="font-size: medium;" class="mt-s">{{$info[0]->content}}</h6>
						<p style="font-size: smaller;">{{$info[0]->type}}</p>
					</div>
				</div>
			</div>

			<div class="row g-5">
				<div class="col-12 col-sm-4">
					<div class="my-3">
						<img src="{{asset('adminOfficial/'.$info[1]->file)}}" class="img-fluid rounded-circle" alt="{{$info[1]->content}}" style="height: 100px;" />
						<h6 style="font-size: medium;" class="mt-3">{{$info[1]->content}}</h6>
						<p style="font-size: smaller;">Barangay Kagawad</p>
						<p style="font-size: smaller;" class="fst-italic">{{$info[1]->type}}</p>
					</div>
				</div>
				<div class="col-12 col-sm-4">
					<div class="my-3">
						<img src="{{asset('adminOfficial/'.$info[2]->file)}}" class="img-fluid rounded-circle" alt="{{$info[2]->content}}" style="height: 100px;" />
						<h6 style="font-size: medium;" class="mt-3">{{$info[2]->content}}</h6>
						<p style="font-size: smaller;">Barangay Kagawad</p>
						<p style="font-size: smaller;" class="fst-italic">{{$info[2]->type}}</p>
					</div>
				</div>
				<div class="col-12 col-sm-4">
					<img src="{{asset('adminOfficial/'.$info[3]->file)}}" class="img-fluid rounded-circle" alt="{{$info[3]->content}}" style="height: 100px;" />
					<h6 style="font-size: medium;" class="mt-3">{{$info[3]->content}}</h6>
					<p style="font-size: smaller;">Barangay Kagawad</p>
					<p style="font-size: smaller;" class="fst-italic">{{$info[3]->type}}</p>
				</div>
			</div>


			<div class="row g-5">
				<div class="col-12 col-sm-4">
					<div class="my-3">
						<img src="{{asset('adminOfficial/'.$info[4]->file)}}" class="img-fluid rounded-circle" alt="{{$info[4]->content}}" style="height: 100px;" />
						<h6 style="font-size: medium;" class="mt-3">{{$info[4]->content}}</h6>
						<p style="font-size: smaller;">Barangay Kagawad</p>
						<p style="font-size: smaller;" class="fst-italic">{{$info[4]->type}}</p>
					</div>
				</div>
				<div class="col-12 col-sm-4">
					<div class="my-3">
						<img src="{{asset('adminOfficial/'.$info[5]->file)}}" class="img-fluid rounded-circle" alt="{{$info[5]->content}}" style="height: 100px;" />
						<h6 style="font-size: medium;" class="mt-3">{{$info[5]->content}}</h6>
						<p style="font-size: smaller;">Barangay Kagawad</p>
						<p style="font-size: smaller;" class="fst-italic">{{$info[5]->type}}</p>
					</div>
				</div>
				<div class="col-12 col-sm-4">
					<div class="my-3">
						<img src="{{asset('adminOfficial/'.$info[6]->file)}}" class="img-fluid rounded-circle" alt="{{$info[6]->content}}" style="height: 100px;" />
						<h6 style="font-size: medium;" class="mt-3">{{$info[6]->content}}</h6>
						<p style="font-size: smaller;">Barangay Kagawad</p>
						<p style="font-size: smaller;" class="fst-italic">{{$info[6]->type}}</p>
					</div>
				</div>
			</div>

			<div class="row g-5">
				<div class="col-12 col-sm-4">
					<div class="my-3">
						<img src="{{asset('adminOfficial/'.$info[7]->file)}}" class="img-fluid rounded-circle" alt="{{$info[7]->content}}" style="height: 100px;" />
						<h6 style="font-size: medium;" class="mt-3">{{$info[7]->content}}</h6>
						<p style="font-size: smaller;">Barangay Kagawad</p>
						<p style="font-size: smaller;" class="fst-italic">{{$info[7]->type}}</p>
					</div>
				</div>
				<div class="col-12 col-sm-4">
					<div class="my-3">
						<img src="{{asset('adminOfficial/'.$info[8]->file)}}" class="img-fluid rounded-circle" alt="{{$info[8]->content}}" style="height: 100px;" />
						<h6 style="font-size: medium;" class="mt-3">{{$info[8]->content}}</h6>
						<p style="font-size: smaller;">SK Chairman</p>
						<p style="font-size: smaller;" class="fst-italic">{{$info[8]->type}}</p>
					</div>
				</div>
				<div class="col-12 col-sm-4">
					<div class="my-3">
						<img src="{{asset('adminOfficial/'.$info[9]->file)}}" class="img-fluid rounded-circle" alt="{{$info[9]->content}}" style="height: 100px;" />
						<h6 style="font-size: medium;" class="mt-3">{{$info[9]->content}}</h6>
						<p style="font-size: smaller;" class="fst-italic">{{$info[9]->type}}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- FOOTER-->
@include('footer')

</html>