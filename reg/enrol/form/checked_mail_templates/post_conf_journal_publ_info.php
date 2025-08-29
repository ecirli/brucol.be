
<?php 
  
  global $hcontent;
  global $_data;
  global $_subject;

  $data = $_data; 
  
  $_subject = 'Journal Publishing '.gc('conf_name_shortest').'' .' - '. $data['name_surname'];

  $hcontent = '
							 <html>
							 <body>
                <h2> '.gc('conf_name_shortest').', Journal Publishing Notice</h2>
                <br>
                <p>Dear corresponding author <b>'.__ucwords($data['name_surname']).'</b>,
                <br>
                <br>
								We are glad to inform you that the journals have been published including opted articles from '.gc('conf_name_shortest').'.<br>
								 <br>
                Thank you for your contributions and congratulations for taking part in this success.
                <br>
								<br>
                Kindly visit the homepage of the conference website '.gc('journal_web').',  to see the published articles in one of the journals.
                <br>
                <br>
                Q. I cannot find my article in a journal. Why?
                <br>
                A. If you selected "No Journal" on your registration, then your article is not included in the journals.
                <br>
                 <br>
                Q. I opted for a journal but sent just an abstract and I cannot find it in the journals. Why?
                <br>
                A. Unfortunately, we do not publish just abstracts in journals.
                <br>
                 <br>
                Q. I did not submit my full paper on time. Can I send it later to be published in a journal?
                <br>
                A. We included only the full papers which were sent within the deadlines. Unfortunately, we cannot add the articles sent afterwards.
                <br>
                 <br>
                Q. I registered in the free journal EJMS, but my article has been published in another journal. Why?
                <br>
                A. Your article is published according to its subject field in a specific journal.
                <br>
                 <br>
                Q. I selected "No Journal" at my registration. Now I changed my mind. Can you publish my article in a journal now?
                <br>
                A. Unfortunately no. The articles have already been processed and the publishing procedure has been completed for the current issues.
                <br>
                However, you can register an article to publish in future issue at <a href="http://euser.org/journals/form/">Register for a Journal</a>.</span></p>
                <br>
                Should you have any questions, please do not hesitate to contact us.
                <br>
                <br> 
                What is next?
                <br>
                - Indexing in Elsevier^s Mendeley, RePEc, WorldCat and Google Scholar will be completed within one week.
                <br>
                - DOI assignment and Crossref indexing will be completed within one week.
                <br>
                - The timetable, proceedings book and conference photos are published on the conference website ('.gc('ltr_conf_web').')
                <br>
								- We will keep you updated regarding our future conferences. Please stay tuned..
            		<br>
                <br>
								Thank you for the collaboration.<br>
								Organizing Committee<br>
								'.gc('conf_name_shortest').'
                </p>
						    </body>
								</html>';