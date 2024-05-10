---
title: 'SERENE: The Semi-Automatic User Experience Detector'
tags:
  - PHP (Laravel)
  - Human-Computer Interaction
  - Human-Centered Artificial Intelligence
  - Affective Computing
authors:
  - name:
      given-names: Andrea
      surname: Esposito
    orcid: 0000-0002-9536-3087
    email: andrea.esposito@uniba.it
    corresponding: true
    affiliation: 1
affiliations:
 - name: Department of Computer Science, University of Bari Aldo Moro, Bari, Italy
   index: 1
#date: 13 August 2017
bibliography: paper.bib
---

# Summary

SERENE (uSer ExpeRiENce dEtector), also known as UX-SAD (User eXperience-Smells Automatic Detector), is a research project born in 2020, which comprises different components. As its name suggests, its primary goal is to provide a way to quickly and (semi-) automatically detect problems in the user experience of websites and web-based systems. Through a set of Artificial Intelligence (AI) models, SERENE detects users' emotions in web pages while guaranteeing users' privacy. Its main strength over typical user experience and usability evaluation is in the generalizability of its detections. While traditional methods use samples (that may not be representative), SERENE allows to tap into data provided by the whole user population.

# Statement of need

Despite the well-documented benefits of usability evaluation methods, they are often neglected by many companies and practitioners. This is primarily due to the perception that usability experts are scarce [@Vanderdonckt2004Automated], and that these methods require significant resources that may not be well-suited to their needs [@Ardito2014Investigating]. However, it is widely recognized that incorporating usability evaluations can significantly enhance the overall quality of products [@Dingli2011USEFul]. To overcome these challenges, automatic or semi-automatic tools can be employed to assist evaluators with insufficient skills in conducting reliable usability evaluations. By utilizing these tools, usability evaluations can be made more efficient, and tailored to better address the specific needs of companies.

User eXperience (UX) has become an increasingly important aspect of software. It is defined by [@ISO2018924111] as “a person’s perceptions and responses resulting from the use and/or anticipated use of a product, system, or service.” Therefore, in general, designing for UX is more than designing for the traditional attributes of usability, as it also focuses on the hedonic aspects of the interaction [@Law2009Understanding]. Since emotions are important elements of UX, some authors have been looking for ways of identifying users’ emotions by analyzing their interaction with systems  [@Desolda2021Detecting].

SERENE is a web platform designed for UX experts to aid the UX evaluation of websites [@Esposito2022SERENE]. In particular, evaluators are guided in the discovery of “UX Smells” [@Buono2020Detection] employing heatmaps, that show the concentration of emotions in the webpage. The ground assumption of this methodology is that areas of the page with usability or UX problems evoke negative emotions in their users [@Li2018Effects].

# Research-Informed Design

The design of SERENE derives from user research, following a typical human-centered design (HCD) approach [@ISO20199241210]. This section briefly details the design of the various components of SERENE.

## Emotion Detection Models

Multiple steps were required to build the privacy-conscious emotion detection component. The initial step was the collection of an in-the-wild dataset of interaction logs (i.e., mouse movements and clicks, as well as aggregated keyboard usage data) linked to emotions [@Desolda2021Detecting]. The emotions were collected through facial recognition using state-of-the-art techniques [@Desolda2021Detecting]. Following the dataset collection phase, multiple machine-learning models were compared to select the better-performing ones for each emotion [@Desolda2021Detecting].

## Visualization of Usability Issues

Various approaches are available to visualize the automatically detected usability issues. Following the automation level framework proposed by @Parasuraman2000Model, then evolved by @Shneiderman2020HumanCentered, three different visualizations were designed. Namely, the classification output can be presented using a full automation, a full control, or a middle-ground solution. Through a user study, @Esposito2024Fine highlighted that a full control or a middle-ground solution allows for the discovery of a higher amount of usability issues. Therefore a full control solution is implemented in this version of the platform, although future versions may allow users to select their preferred visualization style (depending on their goal).

# Acknowledgments

The research of Andrea Esposito is funded by a Ph.D. fellowship within the framework of the Italian "D.M. n. 352, April 9, 2022g - under the National Recovery and Resilience Plan, Mission 4, Component 2, Investment 3.3 - Ph.D. Project "Human-Centered Artificial Intelligence (HCAI) techniques for supporting end users interacting with AI systems", co-supported by "Eusoft S.r.l." (CUP H91I22000410007). Andrea Esposito acknowledges the help of Giuseppe Desolda (without whom this idea wouldn’t be born) and Rosa Lanzilotti, who both took part in the HCD of the various components of the system.

# References
